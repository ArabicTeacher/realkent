<?php
// Get menu items from database
$db = new Database();

// Get available languages
$availableLanguages = $language->getAvailableLanguagesList();

// Get menu items in current language
$db->query('SELECT mi.*, mt.title, mt.url 
            FROM menu_items mi 
            JOIN menu_translations mt ON mi.id = mt.menu_item_id 
            WHERE mi.is_active = TRUE AND mt.language_code = :lang 
            ORDER BY mi.order_index');
$db->bind(':lang', $currentLang);
$menuItems = $db->resultSet();

// Store menu items in session for use in footer
$_SESSION['menu_items'] = $menuItems;
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Real Estate</title>
    
    <!-- Main CSS File -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/main.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="<?php echo BASE_URL; ?>">
                    <h2><?php echo SITE_NAME; ?></h2>
                </a>
            </div>
            
            <nav class="desktop-nav">
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#properties-sale">Properties</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#property-filter" class="search-link"><i class="fas fa-search"></i> Search</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
                
                <div class="language-switcher">
                    <span><?php echo strtoupper($currentLang); ?></span>
                    <ul>
                        <?php foreach ($availableLanguages as $code => $langData): ?>
                        <li><a href="?lang=<?php echo $code; ?>"><?php echo strtoupper($code); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-bottom-nav">
        <div class="nav-item">
            <a href="#about" class="nav-link">
                <i class="fas fa-info-circle"></i>
                <span class="nav-text">About</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#properties-sale" class="nav-link">
                <i class="fas fa-building"></i>
                <span class="nav-text">Properties</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#testimonials" class="nav-link">
                <i class="fas fa-star"></i>
                <span class="nav-text">Testimonials</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#faq" class="nav-link">
                <i class="fas fa-question-circle"></i>
                <span class="nav-text">FAQ</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#contact" class="nav-link">
                <i class="fas fa-phone"></i>
                <span class="nav-text">Contact</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#property-filter" class="nav-link">
                <i class="fas fa-search"></i>
                <span class="nav-text">Search</span>
            </a>
        </div>
    </nav>
    
    <main>