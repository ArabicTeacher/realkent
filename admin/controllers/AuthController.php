<?php
class AuthController {
    private $db;
    private $maxLoginAttempts = 5;
    private $lockoutTime = 900; // 15 minutes in seconds
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function login() {
        // Check if already logged in
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: index.php');
            exit();
        }
        
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verify CSRF token
            if (!isset($_POST['csrf_token']) || !Security::validateCsrfToken($_POST['csrf_token'])) {
                header('Location: login.php?error=1');
                exit();
            }
            
            // Sanitize input - Replace deprecated FILTER_SANITIZE_STRING
            $username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8') : '';
            $password = $_POST['password'] ?? ''; // We'll hash this, so no sanitization needed
            
            // Validate input
            if (empty($username) || empty($password)) {
                header('Location: login.php?error=1');
                exit();
            }
            
            // Check for brute force attacks
            if ($this->checkBruteForce($username)) {
                header('Location: login.php?error=2');
                exit();
            }
            
            // Get user from database
            $this->db->query('SELECT * FROM users WHERE username = :username AND role = "admin"');
            $this->db->bind(':username', $username);
            $user = $this->db->single();
            
            // Verify user exists and password is correct
            if ($user && password_verify($password, $user->password)) {
                // Reset failed login attempts on successful login
                $this->clearLoginAttempts($username);
                
                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);
                
                // Set session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user->id;
                $_SESSION['admin_username'] = $user->username;
                $_SESSION['admin_role'] = $user->role;
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                
                // Update last login timestamp (only if column exists)
                $this->updateLastLogin($user->id);
                
                // Redirect to admin dashboard
                header('Location: index.php');
                exit();
            } else {
                // Record failed login attempt
                $this->recordLoginAttempt($username, false);
                
                header('Location: login.php?error=1');
                exit();
            }
        } else {
            // Display login form
            header('Location: login.php');
            exit();
        }
    }
    
    // Update last login timestamp (with column existence check)
    private function updateLastLogin($userId) {
        try {
            // Check if last_login column exists
            $this->db->query("SHOW COLUMNS FROM users LIKE 'last_login'");
            $columnExists = $this->db->single();
            
            if ($columnExists) {
                $this->db->query('UPDATE users SET last_login = NOW() WHERE id = :id');
                $this->db->bind(':id', $userId);
                $this->db->execute();
            }
        } catch (Exception $e) {
            // Silently fail if column doesn't exist
            error_log("last_login column doesn't exist: " . $e->getMessage());
        }
    }
    
    // Check for brute force attacks
    private function checkBruteForce($username) {
        // Get the current time
        $now = time();
        
        // Count login attempts in the last lockout time period
        $this->db->query('SELECT time FROM login_attempts WHERE username = :username AND time > :time');
        $this->db->bind(':username', $username);
        $this->db->bind(':time', $now - $this->lockoutTime);
        $attempts = $this->db->resultSet();
        
        if (count($attempts) >= $this->maxLoginAttempts) {
            return true;
        }
        
        return false;
    }
    
    // Record login attempt
    private function recordLoginAttempt($username, $success = false) {
        $this->db->query('INSERT INTO login_attempts (username, time, success) VALUES (:username, :time, :success)');
        $this->db->bind(':username', $username);
        $this->db->bind(':time', time());
        $this->db->bind(':success', $success);
        $this->db->execute();
    }
    
    // Clear login attempts after successful login
    private function clearLoginAttempts($username) {
        $this->db->query('DELETE FROM login_attempts WHERE username = :username');
        $this->db->bind(':username', $username);
        $this->db->execute();
    }
    
    // Check if user is logged in (for protecting admin pages)
    public static function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && 
               $_SESSION['admin_logged_in'] === true &&
               self::validateSession();
    }
    
    // Validate session to prevent session hijacking
    private static function validateSession() {
        if (!isset($_SESSION['user_agent']) || !isset($_SESSION['ip_address'])) {
            return false;
        }
        
        return ($_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT'] &&
                $_SESSION['ip_address'] === $_SERVER['REMOTE_ADDR']);
    }
}
?>