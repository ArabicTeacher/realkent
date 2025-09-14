<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Real Estate</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/views/css/login/desktop.css" media="screen and (min-width: 768px)">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/views/css/login/mobile.css" media="screen and (max-width: 767px)">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="logo">
                <h1>Real Estate Admin</h1>
            </div>
            
            <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form action="<?php echo BASE_URL; ?>admin/controllers/AuthController.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>admin/views/js/login/desktop.js"></script>
    <script src="<?php echo BASE_URL; ?>admin/views/js/login/mobile.js"></script>
</body>
</html>