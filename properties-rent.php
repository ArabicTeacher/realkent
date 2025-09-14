<?php
require_once 'config/config.php';
require_once 'config/database.php';

spl_autoload_register(function($className) {
    $directories = ['lib/', 'controllers/', 'models/'];
    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$language = new Language();
$currentLang = $language->getLanguage();

$db = new Database();

// Pagination setup
$limit = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total
$db->query('SELECT COUNT(*) as total FROM properties WHERE purpose = "rent"');
$totalResult = $db->single();
$totalProperties = $totalResult->total;
$totalPages = ceil($totalProperties / $limit);

// Fetch properties
$db->query('SELECT p.*, pt.title, pt.description, pi.image_path 
           FROM properties p 
           LEFT JOIN property_translations pt ON p.id = pt.property_id AND pt.language_code = :lang 
           LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_main = TRUE 
           WHERE p.purpose = "rent"
           ORDER BY p.created_at DESC
           LIMIT :offset, :limit');
$db->bind(':lang', $currentLang);
$db->bind(':offset', $offset, PDO::PARAM_INT);
$db->bind(':limit', $limit, PDO::PARAM_INT);
$properties = $db->resultSet();

require_once 'views/includes/header.php';
?>

<section class="properties-listing-section">
    <div class="container">
        <h1 class="page-title">Properties for Rent</h1>
        
        <div class="listing-content">
            <aside class="filter-sidebar">
                <h3>Filter Properties</h3>
                <!-- filters unchanged -->
            </aside>
            
            <main class="properties-grid">
                <?php if (count($properties) > 0): ?>
                    <?php foreach ($properties as $property): ?>
                    <div class="property-card">
                        <div class="property-image">
                            <img src="<?php echo BASE_URL . ($property->image_path ?: 'assets/images/property-placeholder.jpg'); ?>" alt="<?php echo $property->title; ?>">
                            <div class="property-type"><?php echo ucfirst($property->type); ?></div>
                            <div class="property-price">$<?php echo number_format($property->price); ?>/month</div>
                        </div>
                        <div class="property-details">
                            <h3><?php echo $property->title; ?></h3>
                            <p class="property-location"><i class="fas fa-map-marker-alt"></i> <?php echo $property->location; ?></p>
                            <div class="property-features">
                                <span><i class="fas fa-bed"></i> <?php echo $property->rooms; ?> Bedrooms</span>
                                <span><i class="fas fa-bath"></i> <?php echo $property->bathrooms; ?> Bathrooms</span>
                                <span><i class="fas fa-ruler-combined"></i> <?php echo $property->area; ?> m²</span>
                            </div>
                            <a href="property-details.php?id=<?php echo $property->id; ?>" class="view-details-btn">View Details</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-properties">
                        <h3>No properties found</h3>
                        <p>Try adjusting your filters to see more results.</p>
                    </div>
                <?php endif; ?>
            </main>

            <?php if ($totalPages > 1): ?>
            <nav class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=1" class="first">First</a>
                    <a href="?page=<?php echo $page - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <?php
                $range = 2;
                for ($i = max(1, $page - $range); $i <= min($totalPages, $page + $range); $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="next">Next</a>
                    <a href="?page=<?php echo $totalPages; ?>" class="last">Last</a>
                <?php endif; ?>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</section>

<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-listing/desktop.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-listing/mobile.css">

<?php require_once 'views/includes/footer.php'; ?>