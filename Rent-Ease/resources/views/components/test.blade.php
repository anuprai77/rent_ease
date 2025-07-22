    <style>
        #testimonialSlider::-webkit-scrollbar {
            display: none;
        }
        #testimonialSlider {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .testimonial-card {
            transition: all 0.3s ease;
        }
        
        .testimonial-card.focused {
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 2px solid #3b82f6;
        }
        
        .testimonial-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .testimonial-card.focused:hover {
            transform: scale(1.05) translateY(-2px);
        }
        
        .nav-button {
            transition: all 0.2s ease;
        }
        
        .nav-button:hover {
            background-color: #f3f4f6;
            transform: scale(1.1);
        }
        
        .nav-button:active {
            transform: scale(0.95);
        }
        
        .indicator-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #cbd5e1;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dot.active {
            background-color: #3b82f6;
            transform: scale(1.2);
        }
        
        .dot:hover {
            background-color: #64748b;
        }
    </style>
</head>
<body class="bg-gray-100">
    <section class="bg-gray-200 py-16 relative">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">What Our Customers Say</h2>

            <button id="prev" class="nav-button absolute left-2 top-1/2 transform -translate-y-1/2 bg-white p-3 rounded-full shadow-lg z-10">
                <i class="fas fa-chevron-left text-gray-600"></i>
            </button>
            <button id="next" class="nav-button absolute right-2 top-1/2 transform -translate-y-1/2 bg-white p-3 rounded-full shadow-lg z-10">
                <i class="fas fa-chevron-right text-gray-600"></i>
            </button>

            <div class="overflow-hidden">
                <div id="testimonialSlider" class="flex space-x-6 snap-x snap-mandatory overflow-x-scroll px-2 scroll-smooth">
                    <div class="testimonial-card min-w-[300px] bg-white p-6 rounded-xl shadow-md snap-start" tabindex="0">
                        <p class="text-gray-700 mb-4">"Renting from RentEase was so convenient and easy. The process was smooth, and their customer service was excellent. Highly recommended!"</p>
                        <div class="text-sm text-gray-600">
                            <strong>Himal Chaudhary</strong>, Dharan
                        </div>
                    </div>
                    <div class="testimonial-card min-w-[300px] bg-white p-6 rounded-xl shadow-md snap-start" tabindex="0">
                        <p class="text-gray-700 mb-4">"I found the perfect apartment through RentEase. Their listings are comprehensive, and the filtering options made my search effortless."</p>
                        <div class="text-sm text-gray-600">
                            <strong>Alisha Singh</strong>, Kathmandu
                        </div>
                    </div>
                    <div class="testimonial-card min-w-[300px] bg-white p-6 rounded-xl shadow-md snap-start" tabindex="0">
                        <p class="text-gray-700 mb-4">"As a landlord, using RentEase has simplified managing my properties. The platform is user-friendly and helps me connect with reliable tenants."</p>
                        <div class="text-sm text-gray-600">
                            <strong>Prakash Thapa</strong>, Pokhara
                        </div>
                    </div>
                    <div class="testimonial-card min-w-[300px] bg-white p-6 rounded-xl shadow-md snap-start" tabindex="0">
                        <p class="text-gray-700 mb-4">"Excellent experience! The team at RentEase is very supportive and responsive. They made my relocation stress-free."</p>
                        <div class="text-sm text-gray-600">
                            <strong>Sushma Gurung</strong>, Lalitpur
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Indicator dots -->
            <div class="indicator-dots" id="indicatorDots"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.getElementById('testimonialSlider');
            const nextBtn = document.getElementById('next');
            const prevBtn = document.getElementById('prev');
            const indicatorContainer = document.getElementById('indicatorDots');
            const originalCards = Array.from(slider.querySelectorAll('.testimonial-card'));

            if (originalCards.length === 0) {
                console.warn('No testimonial cards found.');
                return;
            }

            let currentIndex = 0;
            let autoSlideInterval;
            let isUserInteracting = false;
            let focusedCard = null;
            const autoSlideDelay = 4000;

            // Calculate card dimensions
            const getCardWidth = () => {
                const card = originalCards[0];
                const style = getComputedStyle(card);
                const marginRight = parseFloat(style.marginRight) || 24;
                return card.offsetWidth + marginRight;
            };

            // Create indicator dots
            const createIndicators = () => {
                indicatorContainer.innerHTML = '';
                originalCards.forEach((_, index) => {
                    const dot = document.createElement('div');
                    dot.className = 'dot';
                    dot.addEventListener('click', () => goToSlide(index));
                    indicatorContainer.appendChild(dot);
                });
                updateIndicators();
            };

            // Update indicator dots
            const updateIndicators = () => {
                const dots = indicatorContainer.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            };

            // Create infinite loop by cloning cards
            const setupInfiniteLoop = () => {
                const clonesBefore = originalCards.map(card => {
                    const clone = card.cloneNode(true);
                    clone.addEventListener('focus', handleCardFocus);
                    clone.addEventListener('blur', handleCardBlur);
                    return clone;
                });
                
                const clonesAfter = originalCards.map(card => {
                    const clone = card.cloneNode(true);
                    clone.addEventListener('focus', handleCardFocus);
                    clone.addEventListener('blur', handleCardBlur);
                    return clone;
                });

                clonesBefore.reverse().forEach(card => slider.prepend(card));
                clonesAfter.forEach(card => slider.append(card));

                // Position at original cards
                const cardWidth = getCardWidth();
                slider.scrollLeft = clonesBefore.length * cardWidth;
            };

            // Handle card focus
            const handleCardFocus = (e) => {
                stopAutoSlide();
                isUserInteracting = true;
                
                // Remove focus from other cards
                document.querySelectorAll('.testimonial-card.focused').forEach(card => {
                    card.classList.remove('focused');
                });
                
                // Add focus to current card
                e.target.classList.add('focused');
                focusedCard = e.target;
                
                // Update current index based on focused card
                const allCards = Array.from(slider.querySelectorAll('.testimonial-card'));
                const cardIndex = allCards.indexOf(e.target);
                const originalCardsLength = originalCards.length;
                
                if (cardIndex >= originalCardsLength && cardIndex < originalCardsLength * 2) {
                    currentIndex = cardIndex - originalCardsLength;
                    updateIndicators();
                }
            };

            // Handle card blur
            const handleCardBlur = (e) => {
                setTimeout(() => {
                    if (!document.activeElement || !document.activeElement.classList.contains('testimonial-card')) {
                        e.target.classList.remove('focused');
                        focusedCard = null;
                        isUserInteracting = false;
                        startAutoSlide();
                    }
                }, 100);
            };

            // Go to specific slide
            const goToSlide = (index) => {
                stopAutoSlide();
                isUserInteracting = true;
                currentIndex = index;
                
                const cardWidth = getCardWidth();
                const targetScroll = (originalCards.length + index) * cardWidth;
                
                slider.scrollTo({
                    left: targetScroll,
                    behavior: 'smooth'
                });
                
                updateIndicators();
                
                setTimeout(() => {
                    isUserInteracting = false;
                    startAutoSlide();
                }, 1000);
            };

            // Navigate to next slide
            const nextSlide = () => {
                currentIndex = (currentIndex + 1) % originalCards.length;
                const cardWidth = getCardWidth();
                slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                updateIndicators();
            };

            // Navigate to previous slide
            const prevSlide = () => {
                currentIndex = (currentIndex - 1 + originalCards.length) % originalCards.length;
                const cardWidth = getCardWidth();
                slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                updateIndicators();
            };

            // Handle infinite scroll looping
            const handleScrollLooping = () => {
                clearTimeout(slider._scrollTimeout);
                slider._scrollTimeout = setTimeout(() => {
                    const currentScroll = slider.scrollLeft;
                    const cardWidth = getCardWidth();
                    const totalCards = originalCards.length;

                    // Check boundaries and loop
                    if (currentScroll >= (totalCards * 2) * cardWidth - 50) {
                        slider.scrollLeft = totalCards * cardWidth;
                    } else if (currentScroll <= totalCards * cardWidth - cardWidth - 50) {
                        slider.scrollLeft = (totalCards * 2 - 1) * cardWidth;
                    }

                    // Update current index based on scroll position
                    const newIndex = Math.round((currentScroll - totalCards * cardWidth) / cardWidth);
                    if (newIndex >= 0 && newIndex < totalCards && newIndex !== currentIndex) {
                        currentIndex = newIndex;
                        updateIndicators();
                    }
                }, 100);
            };

            // Auto-slide functions
            const startAutoSlide = () => {
                if (isUserInteracting || focusedCard) return;
                stopAutoSlide();
                autoSlideInterval = setInterval(() => {
                    if (!isUserInteracting && !focusedCard) {
                        nextSlide();
                    }
                }, autoSlideDelay);
            };

            const stopAutoSlide = () => {
                clearInterval(autoSlideInterval);
            };

            // Event listeners
            slider.addEventListener('scroll', handleScrollLooping);

            nextBtn.addEventListener('click', () => {
                stopAutoSlide();
                isUserInteracting = true;
                nextSlide();
                setTimeout(() => {
                    isUserInteracting = false;
                    startAutoSlide();
                }, 1000);
            });

            prevBtn.addEventListener('click', () => {
                stopAutoSlide();
                isUserInteracting = true;
                prevSlide();
                setTimeout(() => {
                    isUserInteracting = false;
                    startAutoSlide();
                }, 1000);
            });

            // Pause on hover
            slider.addEventListener('mouseenter', () => {
                isUserInteracting = true;
                stopAutoSlide();
            });

            slider.addEventListener('mouseleave', () => {
                if (!focusedCard) {
                    isUserInteracting = false;
                    startAutoSlide();
                }
            });

            // Add focus/blur event listeners to original cards
            originalCards.forEach(card => {
                card.addEventListener('focus', handleCardFocus);
                card.addEventListener('blur', handleCardBlur);
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    prevBtn.click();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    nextBtn.click();
                }
            });

            // Initialize
            setupInfiniteLoop();
            createIndicators();
            startAutoSlide();

            // Handle window resize
            window.addEventListener('resize', () => {
                const cardWidth = getCardWidth();
                slider.scrollLeft = (originalCards.length + currentIndex) * cardWidth;
            });
        });
    </script>