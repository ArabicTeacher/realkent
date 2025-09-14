<section class="properties-section lands-sale">
    <div class="container">
        <h2 class="section-title">Lands for Sale</h2>
        <p class="section-subtitle">Find the perfect plot for your dream project</p>
        
        <div class="properties-carousel">
            <div class="carousel-container">
                <div class="carousel-track">
                    <?php
                    // Get lands for sale from database
                    $db = new Database();
                    $db->query('SELECT p.*, pt.title, pt.description, pi.image_path 
                               FROM properties p 
                               LEFT JOIN property_translations pt ON p.id = pt.property_id AND pt.language_code = :lang 
                               LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_main = TRUE 
                               WHERE p.purpose = "sale" AND p.type = "land" 
                               ORDER BY p.created_at DESC LIMIT 8');
                    $db->bind(':lang', $currentLang);
                    $properties = $db->resultSet();
                    
                    // Sample images for lands
                    $sampleImages = [
                        'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1511216113906-8f57bb83e776?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1504198266287-1659872e6590?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1476820865390-c52aeebb9891?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                    ];
                    
                    if (count($properties) > 0):
                        foreach ($properties as $index => $property):
                            // Use sample image if no image from database
                            $imageSrc = $property->image_path ? 
                                BASE_URL . $property->image_path : 
                                $sampleImages[$index % count($sampleImages)];
                    ?>
                    <div class="carousel-slide">
                        <div class="property-card land-card">
                            <div class="property-image">
                                <img src="<?php echo $imageSrc; ?>" alt="<?php echo $property->title; ?>">
                                <div class="property-type">Land Plot</div>
                                <div class="property-price">$<?php echo number_format($property->price); ?></div>
                                <div class="property-overlay">
                                    <a href="property-details.php?id=<?php echo $property->id; ?>" class="view-details-btn">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                            
                            <div class="property-details">
                                <h3><?php echo $property->title; ?></h3>
                                <p class="property-location"><i class="fas fa-map-marker-alt"></i> <?php echo $property->location; ?></p>
                                
                                <div class="property-features">
                                    <span><i class="fas fa-ruler-combined"></i> <?php echo $property->area; ?> m²</span>
                                    <span><i class="fas fa-map"></i> <?php echo $property->region; ?></span>
                                    <span><i class="fas fa-tag"></i> Land Plot</span>
                                </div>
                                
                                <div class="property-description">
                                   <?= substr($land['description'] ?? '', 0, 100) ?>...</p>
                                </div>
                                
                                <div class="property-actions">
                                    <a href="property-details.php?id=<?php echo $property->id; ?>" class="btn btn-small">View Details</a>
                                    <button class="btn-icon favorite-btn" data-property-id="<?php echo $property->id; ?>">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    else:
                        // Show sample lands if no database properties
                        for ($i = 0; $i < 6; $i++):
                            $locations = ['Istanbul', 'Antalya', 'Bodrum', 'Fethiye', 'Alanya', 'Marmaris'];
                            $regions = ['Coastal', 'Urban', 'Rural', 'Mountain', 'Valley', 'Forest'];
                    ?>
                    <div class="carousel-slide">
                        <div class="property-card land-card">
                            <div class="property-image">
                                <img src="<?php echo $sampleImages[$i]; ?>" alt="Land Plot <?php echo $i + 1; ?>">
                                <div class="property-type">Land Plot</div>
                                <div class="property-price">$<?php echo number_format(80000 + ($i * 20000)); ?></div>
                                <div class="property-overlay">
                                    <a href="#" class="view-details-btn">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                            
                            <div class="property-details">
                                <h3>Premium Land Plot in <?php echo $locations[$i]; ?></h3>
                                <p class="property-location"><i class="fas fa-map-marker-alt"></i> <?php echo $locations[$i]; ?>, Turkey</p>
                                
                                <div class="property-features">
                                    <span><i class="fas fa-ruler-combined"></i> <?php echo 500 + ($i * 100); ?> m²</span>
                                    <span><i class="fas fa-map"></i> <?php echo $regions[$i]; ?> Area</span>
                                    <span><i class="fas fa-tag"></i> Land Plot</span>
                                </div>
                                
                                <div class="property-description">
                                    <p>Beautiful land plot perfect for building your dream home or investment property in <?php echo $locations[$i]; ?>.</p>
                                </div>
                                
                                <div class="property-actions">
                                    <a href="#" class="btn btn-small">View Details</a>
                                    <button class="btn-icon favorite-btn">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endfor;
                    endif;
                    ?>
                </div>
            </div>
            
            <button class="carousel-prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-next">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div class="carousel-dots"></div>
        </div>
        
        <div class="section-actions">
            <a href="lands.php" class="btn">View All Lands for Sale</a>
        </div>
    </div>
</section>

<!-- CSS for Properties Carousel -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-carousel/desktop.css" media="screen and (min-width: 768px)">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-carousel/mobile.css" media="screen and (max-width: 767px)">

<!-- JavaScript for Properties Carousel -->
<script src="<?php echo BASE_URL; ?>views/js/properties-carousel/desktop.js"></script>
<script src="<?php echo BASE_URL; ?>views/js/properties-carousel/mobile.js"></script>