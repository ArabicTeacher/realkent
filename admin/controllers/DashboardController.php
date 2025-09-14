<?php
class DashboardController {
    public function index() {
        // Check if user is logged in
        if (!AuthController::isLoggedIn()) {
            header('Location: ' . BASE_URL . 'admin/login.php');
            exit();
        }
        
        // Get statistics for dashboard
        $db = new Database();
        
        // Count properties
        $db->query('SELECT COUNT(*) as total FROM properties');
        $properties = $db->single()->total;
        
        // Count users
        $db->query('SELECT COUNT(*) as total FROM users');
        $users = $db->single()->total;
        
        // Get recent properties
        $db->query('SELECT * FROM properties ORDER BY created_at DESC LIMIT 5');
        $recentProperties = $db->resultSet();
        
        require_once 'views/dashboard.php';
    }
}
?>