<?php
class Security {
    // Sanitize input data - replacement for deprecated FILTER_SANITIZE_STRING
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map('self::sanitizeInput', $data);
        }
        
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        
        return $data;
    }
    
    // Sanitize string specifically for database input
    public static function sanitizeString($string) {
        return filter_var($string, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    }
    
    // Generate CSRF token
    public static function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    
    // Validate CSRF token
    public static function validateCsrfToken($token) {
        if (!empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            return true;
        }
        
        return false;
    }
    
    // Validate email format
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    // Escape output for HTML context
    public static function escapeOutput($data) {
        if (is_array($data)) {
            return array_map('self::escapeOutput', $data);
        }
        
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    // Validate file upload
    public static function validateFileUpload($file, $allowedTypes = [], $maxSize = 0) {
        $errors = [];
        
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "File upload error: " . $file['error'];
            return $errors;
        }
        
        // Check file size
        if ($maxSize > 0 && $file['size'] > $maxSize) {
            $errors[] = "File is too large. Maximum size allowed: " . ($maxSize / 1024 / 1024) . "MB";
        }
        
        // Check file type
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!empty($allowedTypes) && !in_array($fileExt, $allowedTypes)) {
            $errors[] = "File type not allowed. Allowed types: " . implode(', ', $allowedTypes);
        }
        
        return $errors;
    }
}
?>