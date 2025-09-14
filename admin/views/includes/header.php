<?php
// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Real Estate</title>
    <link rel="stylesheet" href="views/css/dashboard/desktop.css" media="screen and (min-width: 768px)">
    <link rel="stylesheet" href="views/css/dashboard/mobile.css" media="screen and (max-width: 767px)">
    <style>
        /* Basic styles as fallback */
        .admin-header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-nav {
            background-color: #34495e;
            padding: 0.5rem 2rem;
        }
        
        .admin-nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        
        .admin-nav a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .admin-nav a:hover {
            background-color: #2c3e50;
        }
        
        .admin-main {
            padding: 2rem;
        }
        
        .admin-footer {
            background-color: #ecf0f1;
            padding: 1rem 2rem;
            text-align: center;
            border-top: 1px solid #bdc3c7;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="header-left">
            <h1>Real Estate Admin Panel</h1>
        </div>
        <div class="header-right">
            <span>Welcome, <?php echo $_SESSION['admin_username']; ?></span>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    
    <nav class="admin-nav">
        <ul>
            <li><a href="index.php?section=dashboard">Dashboard</a></li>
            <li><a href="index.php?section=properties">Properties</a></li>
            <li><a href="index.php?section=menu">Menu</a></li>
            <li><a href="index.php?section=content">Content</a></li>
            <li><a href="index.php?section=users">Users</a></li>
        </ul>
    </nav>
    
    <main class="admin-main">