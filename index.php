<?php
// Load configuration
require_once 'config/config.php';
require_once 'config/database.php';

// Auto-load classes
spl_autoload_register(function($className) {
    $directories = [
        'lib/',
        'controllers/',
        'models/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Initialize Language class
$language = new Language();

// Get current language
$currentLang = $language->getLanguage();

// Load header
require_once 'views/includes/header.php';

// Load sections in correct order
// Load sections in correct order
$sections = [
    'hero',    
    'about',
    'properties-sale',
    'properties-rent',  // This is our new carousel section
	'lands-sale',  // This is our new lands carousel section
	'property-filter',
    'testimonials',
    'faq',
    'contact-map'
];

foreach ($sections as $section) {
    $filePath = "views/sections/{$section}.php";
    if (file_exists($filePath)) {
        require_once $filePath;
    }
}
// Load footer
require_once 'views/includes/footer.php';
?>