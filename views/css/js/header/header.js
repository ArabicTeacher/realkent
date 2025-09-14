document.addEventListener('DOMContentLoaded', function() {
    // Make header sticky on scroll
    const header = document.querySelector('.main-header');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
    });
    
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    
    if (mobileMenuToggle && mobileNav) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileNav.classList.toggle('active');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.mobile-nav') && !event.target.closest('.mobile-menu-toggle')) {
                mobileNav.classList.remove('active');
            }
        });
    }
    
    // Language switcher functionality
    const languageSwitcher = document.querySelector('.language-switcher');
    
    if (languageSwitcher) {
        languageSwitcher.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});