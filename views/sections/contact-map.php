<section id="contact" class="contact-map-section">
    <div class="container">
        <h2 class="section-title">Contact Us</h2>
        <p class="section-subtitle">Get in touch with our team for any inquiries</p>
        
        <div class="contact-map-content">
            <div class="contact-form-container">
                <form class="contact-form" id="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" placeholder="Your full name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="Your email address" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" placeholder="Message subject" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="inquiry-type">Inquiry Type *</label>
                            <select id="inquiry-type" name="inquiry_type" required>
                                <option value="">Select inquiry type</option>
                                <option value="proposal">Proposal</option>
                                <option value="request">Request</option>
                                <option value="general">General Question</option>
                                <option value="property">Property Inquiry</option>
                                <option value="investment">Investment Opportunity</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" placeholder="Your message..." rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
            
            <div class="map-container">
                <div class="map-placeholder">
                    <div class="map-content">
                        <h3>Our Location</h3>
                        
                        <div class="contact-info-columns">
                            <div class="contact-info-column">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <h4>Address</h4>
                                        <p>Istanbul, Turkey</p>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <h4>Phone</h4>
                                        <p>+90 123 456 7890</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="contact-info-column">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <h4>Email</h4>
                                        <p>info@realestate.com</p>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <h4>Working Hours</h4>
                                        <p>Mon-Fri: 9:00 AM - 6:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Map placeholder - can be replaced with Google Maps API -->
                        <div class="static-map">
                            <div class="map-image">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?center=Istanbul,Turkey&zoom=13&size=600x300&maptype=roadmap&markers=color:red%7CIstanbul,Turkey&key=YOUR_API_KEY" 
                                     alt="Istanbul Map" onerror="this.style.display='none'">
                                <div class="map-fallback">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <p>Interactive map will be displayed here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS for Contact & Map -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/contact-map/desktop.css" media="screen and (min-width: 768px)">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/contact-map/mobile.css" media="screen and (max-width: 767px)">

<!-- JavaScript for Contact Form -->
<script src="<?php echo BASE_URL; ?>views/js/contact-form/desktop.js"></script>
<script src="<?php echo BASE_URL; ?>views/js/contact-form/mobile.js"></script>