<?php
// Load configuration
require_once '../config/config.php';

// Destroy session
session_unset();
session_destroy();

// Redirect to login page
header('Location: login.php?message=logout');
exit();
?>