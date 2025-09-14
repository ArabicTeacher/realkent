<section id="properties-sale" class="properties-section properties-sale">
    <div class="container">
        <h2 class="section-title">Properties for Sale</h2>
        <p class="section-subtitle">Discover our exclusive selection of properties for sale</p>
        
        <div class="properties-carousel">
            <div class="carousel-container">
                <div class="carousel-track">
                    <?php
                    // Get properties for sale from database
                    $db = new Database();
                    $db->query('SELECT p.*, pt.title, pt.description, pi.image_path 
                               FROM properties p 
                               LEFT JOIN property_translations pt ON p.id = pt.property_id AND pt.language_code = :lang 
                               LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_main = TRUE 
                               WHERE p.purpose = "sale" AND p.type != "land" 
                               ORDER BY p.created_at DESC LIMIT 8');
                    $db->bind(':lang', $currentLang);
                    $properties = $db->resultSet();
                    
                    // Sample images for demonstration
                    $sampleImages = [
                        'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1586448900407-7397af48d116?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                    ];
                    
                    if (count($properties) > 0):
                        foreach ($properties as $index => $property):
                            // Use sample image if no image from database
                            $imageSrc = $property->image_path ? 
                                BASE_URL . $property->image_path : 
                                $sampleImages[$index % count($sampleImages)];
                    ?>
                    <div class="carousel-slide">
                        <div class="property-card">
                            <div class="property-image">
                                <img src="<?php echo $imageSrc; ?>" alt="<?php echo $property->title; ?>">
                                <div class="property-type"><?php echo ucfirst($property->type); ?></div>
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
                                    <span><i class="fas fa-bed"></i> <?php echo $property->rooms; ?> Bed</span>
                                    <span><i class="fas fa-bath"></i> <?php echo $property->bathrooms; ?> Bath</span>
                                    <span><i class="fas fa-ruler-combined"></i> <?php echo $property->area; ?> m²</span>
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
                        // Show sample properties if no database properties
                        for ($i = 0; $i < 6; $i++):
                    ?>
                    <div class="carousel-slide">
                        <div class="property-card">
                            <div class="property-image">
                                <img src="<?php echo $sampleImages[$i]; ?>" alt="Luxury Apartment <?php echo $i + 1; ?>">
                                <div class="property-type"><?php echo $i % 2 == 0 ? 'Apartment' : 'Villa'; ?></div>
                                <div class="property-price">$<?php echo number_format(250000 + ($i * 50000)); ?></div>
                                <div class="property-overlay">
                                    <a href="#" class="view-details-btn">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                            
                            <div class="property-details">
                                <h3>Luxury <?php echo $i % 2 == 0 ? 'Apartment' : 'Villa'; ?> in Istanbul</h3>
                                <p class="property-location"><i class="fas fa-map-marker-alt"></i> Istanbul, Turkey</p>
                                
                                <div class="property-features">
                                    <span><i class="fas fa-bed"></i> <?php echo 2 + $i; ?> Bed</span>
                                    <span><i class="fas fa-bath"></i> <?php echo 1 + ($i % 2); ?> Bath</span>
                                    <span><i class="fas fa-ruler-combined"></i> <?php echo 80 + ($i * 20); ?> m²</span>
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
            <a href="properties-sale.php" class="btn">View All Properties for Sale</a>
        </div>
    </div>
</section>

<!-- CSS for Properties Carousel -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-carousel/desktop.css" media="screen and (min-width: 768px)">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/properties-carousel/mobile.css" media="screen and (max-width: 767px)">

<!-- JavaScript for Properties Carousel -->
<script src="<?php echo BASE_URL; ?>views/js/properties-carousel/desktop.js"></script>
<script src="<?php echo BASE_URL; ?>views/js/properties-carousel/mobile.js"></script>