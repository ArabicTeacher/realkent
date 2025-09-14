document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.properties-carousel');
    if (!carousels || carousels.length === 0) return;

    carousels.forEach(carousel => {
        (function initCarousel(carousel) {
            const track = carousel.querySelector('.carousel-track');
            const slides = carousel.querySelectorAll('.carousel-slide');
            const prevBtn = carousel.querySelector('.carousel-prev');
            const nextBtn = carousel.querySelector('.carousel-next');
            const dotsContainer = carousel.querySelector('.carousel-dots');

            if (!track || slides.length === 0) return;

            let currentIndex = 0;
            // safe slide width calculation
            let slideWidth = (slides[0] && slides[0].offsetWidth) ? slides[0].offsetWidth + 32 : carousel.clientWidth;
            let autoSlideInterval;

            // Create dots
            dotsContainer && (dotsContainer.innerHTML = '');
            slides.forEach((_, index) => {
                if (!dotsContainer) return;
                const dot = document.createElement('button');
                dot.classList.add('carousel-dot');
                dot.setAttribute('aria-label', 'Go to slide ' + (index + 1));
                dot.addEventListener('click', () => {
                    goToSlide(index);
                    resetAutoSlide();
                });
                dotsContainer.appendChild(dot);
            });

            function updateDots() {
                if (!dotsContainer) return;
                const dots = dotsContainer.querySelectorAll('.carousel-dot');
                dots.forEach(d => d.classList.remove('active'));
                if (dots[currentIndex]) dots[currentIndex].classList.add('active');
            }

            function goToSlide(index) {
                if (index < 0) index = 0;
                if (index >= slides.length) index = slides.length - 1;
                currentIndex = index;
                const distance = - (slideWidth * currentIndex);
                track.style.transform = `translateX(${distance}px)`;
                updateDots();
            }

            function nextSlide() {
                if (currentIndex >= slides.length - 1) {
                    goToSlide(0);
                } else {
                    goToSlide(currentIndex + 1);
                }
            }

            function prevSlide() {
                if (currentIndex <= 0) {
                    goToSlide(slides.length - 1);
                } else {
                    goToSlide(currentIndex - 1);
                }
            }

            prevBtn && prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoSlide();
            });
            nextBtn && nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoSlide();
            });

            function startAutoSlide() {
                stopAutoSlide();
                autoSlideInterval = setInterval(nextSlide, 4000);
            }

            function stopAutoSlide() {
                if (autoSlideInterval) {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = null;
                }
            }

            function resetAutoSlide() {
                stopAutoSlide();
                startAutoSlide();
            }

            // Pause on hover
            carousel.addEventListener('mouseenter', stopAutoSlide);
            carousel.addEventListener('mouseleave', startAutoSlide);

            // Handle resize
            window.addEventListener('resize', () => {
                slideWidth = (slides[0] && slides[0].offsetWidth) ? slides[0].offsetWidth + 32 : carousel.clientWidth;
                goToSlide(currentIndex);
            });

            // Initialize favorites (if any)
            const favoriteBtns = carousel.querySelectorAll('.favorite-btn');
            favoriteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon && icon.classList.remove('far');
                        icon && icon.classList.add('fas');
                    } else {
                        icon && icon.classList.remove('fas');
                        icon && icon.classList.add('far');
                    }
                });
            });

            // Kick off
            updateDots();
            goToSlide(0);
            startAutoSlide();

        })(carousel);
    });
});
