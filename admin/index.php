<?php
// Load configuration
require_once '../config/config.php';
require_once '../config/database.php';

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Enhanced autoloader that checks multiple directories
spl_autoload_register(function($className) {
    $directories = [
        '../lib/',
        'controllers/',
        '../controllers/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    
    // If class not found, show error
    die("Class $className not found in any of the searched directories.");
});

// Load admin header
require_once 'views/includes/header.php';

// Route admin requests
$section = isset($_GET['section']) ? $_GET['section'] : 'dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Security check - prevent directory traversal
$section = preg_replace('/[^a-zA-Z0-9_]/', '', $section);
$action = preg_replace('/[^a-zA-Z0-9_]/', '', $action);

// Load appropriate controller
$controllerFile = 'controllers/' . ucfirst($section) . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($section) . 'Controller';
    
    // Check if class exists and method is callable
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            // Show 404 error
            echo "<h2>Action not found</h2>";
            echo "<p>The requested action '$action' was not found.</p>";
        }
    } else {
        // Show 404 error
        echo "<h2>Controller not found</h2>";
        echo "<p>The requested controller '$controllerClass' was not found.</p>";
    }
} else {
    // Show 404 error
    echo "<h2>Page not found</h2>";
    echo "<p>The requested page was not found.</p>";
}

// Load admin footer
require_once 'views/includes/footer.php';