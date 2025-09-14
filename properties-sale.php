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

// Get properties for sale
$db = new Database();
$db->query('SELECT p.*, pt.title, pt.description, pi.image_path 
           FROM properties p 
           LEFT JOIN property_translations pt ON p.id = pt.property_id AND pt.language_code = :lang 
           LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_main = TRUE 
           WHERE p.purpose = "sale" AND p.type != "land"
           ORDER BY p.created_at DESC');
$db->bind(':lang', $currentLang);
$properties = $db->resultSet();

// Pagination setup
$itemsPerPage = 20;
$totalItems = count($properties);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedProperties = array_slice($properties, $startIndex, $itemsPerPage);

// Load header
require_once 'views/includes/header.php';
?>

<section class="properties-listing-section">
    <div class="container">
        <h1 class="page-title">Properties for Sale</h1>
        
        <div class="listing-content">
            <aside class="filter-sidebar">
                <h3>Filter Properties</h3>
                <form class="filter-form" id="properties-filter-form">
                    <div class="filter-group">
                        <label for="property-type">Property Type</label>
                        <select id="property-type" name="type">
                            <option value="">Any Type</option>
                            <option value="apartment">Apartment</option>
                            <option value="villa">Villa</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="price-range">Price Range ($)</label>
                        <div class="range-slider">
                            <input type="range" id="price-range" name="price_range" min="0" max="1000000" step="10000" value="500000">
                            <div class="range-values">
                                <span>$0</span> - <span id="price-value">$500,000</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" placeholder="Enter location">
                    </div>
                    
                    <div class="filter-group">
                        <label for="rooms">Bedrooms</label>
                        <select id="rooms" name="rooms">
                            <option value="">Any</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="area-range">Area Range (m²)</label>
                        <div class="range-slider">
                            <input type="range" id="area-range" name="area_range" min="0" max="1000" step="10" value="300">
                            <div class="range-values">
                                <span>0</span> - <span id="area-value">300</span> m²
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="btn">Apply Filters</button>
                        <button type="reset" class="btn btn-outline">Reset</button>
                    </div>
                </form>
            </aside>
            
            <main class="properties-grid">
                <?php if (count($paginatedProperties) > 0): ?>
                    <?php foreach ($paginatedProperties as $property): ?>
                    <div class="property-card">
                        <div class="property-image">
                            <img src="<?php echo BASE_URL . ($property->image_path ?: 'assets/images/property-placeholder.jpg'); ?>" alt="<?php echo $property->title; ?>">
                            <div class="property-type"><?php echo ucfirst($property->type); ?></div>
                            <div class="property-price">$<?php echo number_format($property->price); ?></div>
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

            <!-- ✅ Pagination -->
            <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=1" class="first">First</a>
                    <a href="?page=<?php echo $currentPage - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $currentPage ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?php echo $currentPage + 1; ?>" class="next">Next</a>
                    <a href="?page=<?php echo $totalPages; ?>" class="last">Last</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Pagination CSS -->
<style>
.pagination {
    margin: 20px 0;
    display: flex;
    justify-content: flex-end; /* ✅ aligns right */
    gap: 8px;
    width: 100%;
}
.pagination a {
    padding: 8px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    color: #333;
    text-decoration: none;
    transition: all 0.2s;
}
.pagination a:hover {
    background: #f0f0f0;
}
.pagination a.active {
    background: #007bff;
    color: #fff;
    border-color: #007bff;
    font-weight: bold;
}
</style>

<!-- CSS for Properties Listing -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-listing/desktop.css" media="screen and (min-width: 768px)">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-listing/mobile.css" media="screen and (max-width: 767px)">

<!-- JavaScript for Properties Listing -->
<script src="<?php echo BASE_URL; ?>views/js/properties-listing/desktop.js"></script>
<script src="<?php echo BASE_URL; ?>views/js/properties-listing/mobile.js"></script>

<?php
// Load footer
require_once 'views/includes/footer.php';
?>