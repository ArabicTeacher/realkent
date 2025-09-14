<section id="property-filter" class="property-filter-section">
    <div class="container">
        <h2 class="section-title">Find Your Perfect Property</h2>
        <p class="section-subtitle">Use our advanced filters to find exactly what you're looking for</p>
        
        <form class="filter-form" id="property-filter-form">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="property-type">Property Type</label>
                    <select id="property-type" name="type">
                        <option value="">Any Type</option>
                        <option value="apartment">Apartment</option>
                        <option value="villa">Villa</option>
                        <option value="land">Land</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="purpose">Purpose</label>
                    <select id="purpose" name="purpose">
                        <option value="">Any Purpose</option>
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter location">
                </div>
            </div>
            
            <div class="filter-row">
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
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="btn">Search Properties</button>
                <button type="reset" class="btn btn-outline">Reset Filters</button>
            </div>
        </form>
    </div>
</section>

<!-- CSS for Property Filter -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/property-filter/desktop.css" media="screen and (min-width: 768px)">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/css/property-filter/mobile.css" media="screen and (max-width: 767px)">

<!-- JavaScript for Property Filter -->
<script src="<?php echo BASE_URL; ?>views/js/property-filter/desktop.js"></script>
<script src="<?php echo BASE_URL; ?>views/js/property-filter/mobile.js"></script>