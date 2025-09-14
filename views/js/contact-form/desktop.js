document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic form validation
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const subject = document.getElementById('subject');
            const inquiryType = document.getElementById('inquiry-type');
            const message = document.getElementById('message');
            
            let isValid = true;
            
            // Reset previous error states
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(el => el.remove());
            
            const inputs = [name, email, subject, inquiryType, message];
            inputs.forEach(input => {
                input.classList.remove('error');
            });
            
            // Validate each field
            if (!name.value.trim()) {
                showError(name, 'Please enter your name');
                isValid = false;
            }
            
            if (!email.value.trim()) {
                showError(email, 'Please enter your email');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }
            
            if (!subject.value.trim()) {
                showError(subject, 'Please enter a subject');
                isValid = false;
            }
            
            if (!inquiryType.value) {
                showError(inquiryType, 'Please select an inquiry type');
                isValid = false;
            }
            
            if (!message.value.trim()) {
                showError(message, 'Please enter your message');
                isValid = false;
            }
            
            if (isValid) {
                // Form is valid, you can submit it via AJAX or let it submit normally
                // For now, we'll show a success message
                alert('Thank you for your message! We will contact you soon.');
                contactForm.reset();
            }
        });
    }
    
    function showError(input, message) {
        input.classList.add('error');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = '#e74c3c';
        errorDiv.style.fontSize = '0.8rem';
        errorDiv.style.marginTop = '0.3rem';
        errorDiv.textContent = message;
        input.parentNode.appendChild(errorDiv);
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});