        </main>
        
        <footer class="main-footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section">
                        <h3><?php echo SITE_NAME; ?></h3>
                        <p>Your trusted real estate partner for finding the perfect property in Turkey.</p>
                        <div class="footer-contact">
                            <p><i class="fas fa-phone"></i> +90 123 456 7890</p>
                            <p><i class="fas fa-envelope"></i> info@realestate.com</p>
                            <p><i class="fas fa-map-marker-alt"></i> Istanbul, Turkey</p>
                        </div>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Quick Links</h4>
                        <ul>
                            <?php 
                            // Use menu items from session
                            $footerMenuItems = $_SESSION['menu_items'] ?? [];
                            foreach ($footerMenuItems as $item): 
                            ?>
                            <li><a href="<?php echo BASE_URL . $item->url; ?>"><?php echo $item->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Properties</h4>
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>properties.php?purpose=sale">Properties for Sale</a></li>
                            <li><a href="<?php echo BASE_URL; ?>properties.php?purpose=rent">Properties for Rent</a></li>
                            <li><a href="<?php echo BASE_URL; ?>lands.php">Lands for Sale</a></li>
                            <li><a href="<?php echo BASE_URL; ?>special-offers.php">Special Offers</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                        
                        <div class="newsletter">
                            <h4>Newsletter</h4>
                            <form class="newsletter-form">
                                <input type="email" placeholder="Enter your email">
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
                        <div class="footer-links">
                            <a href="<?php echo BASE_URL; ?>privacy.php">Privacy Policy</a>
                            <a href="<?php echo BASE_URL; ?>terms.php">Terms of Service</a>
                            <a href="<?php echo BASE_URL; ?>sitemap.php">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- JavaScript Files -->
        <script src="<?php echo BASE_URL; ?>views/js/header/desktop.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/header/mobile.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/hero/desktop.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/hero/mobile.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/property-filter/desktop.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/property-filter/mobile.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/special-offers/desktop.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/special-offers/mobile.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/testimonials/desktop.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/testimonials/mobile.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/contact-form/desktop.js"></script>
        <script src="<?php echo BASE_URL; ?>views/js/contact-form/mobile.js"></script>
    </body>
    </html>