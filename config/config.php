<?php
// Get the document root and current script path
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);

// Calculate base path
$basePath = str_replace('\\', '/', $scriptPath);
if ($basePath !== '/') {
    $basePath .= '/';
}

// Define BASE_URL
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $basePath);

// Site settings
define('SITE_NAME', 'Real Estate');
define('DEFAULT_LANGUAGE', 'tr');
define('SUPPORTED_LANGUAGES', ['tr', 'ru']);

// Path constants
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
define('UPLOAD_PATH', ROOT_PATH . '/assets/uploads/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB

// Environment
define('ENVIRONMENT', 'development'); // Change to 'production' on live server

// Error reporting
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Session settings - Only start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    session_start();
}

// Debug function
function debug($data) {
    if (ENVIRONMENT === 'development') {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
?>