@props([ 'title' => 'Phones & Vapes 4 All', 'description' => 'Visit Phones &
Vapes 4 All for mobile repairs, accessories, and vape supplies across our UK
locations.', 'image' => null, 'store' => null ]) @php use App\Models\Store; if
(!$store) { $store = Store::where('slug',
'phonesvapes-4all-east-sheen')->first(); } @endphp

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title }}</title>
        <meta name="description" content="{{ $description }}" />
        <meta
            name="keywords"
            content="phones, vapes, mobile repair, accessories, UK vape shop, phones and vapes 4 all"
        />
        <meta name="author" content="KNconsulting" />

        <meta property="og:title" content="{{ $title }}" />
        <meta property="og:description" content="{{ $description }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website" />
        @if($image)
        <meta property="og:image" content="{{ $image }}" />
        @endif @vite('resources/css/app.css') @livewireStyles
    </head>

    <!-- Swiper Styles -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <!-- Styles for progress bar and custom elements -->
    <style>
        .swiper-progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 10;
        }

        .swiper-progress-bar .progress {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background: #4f46e5;
            width: 0;
            transition: width 0.1s linear;
        }

        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.8);
            opacity: 0.6;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #ffffff;
        }
    </style>

    <!-- Improved script with more features -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize main swiper
            const mainSwiper = new Swiper(".mySwiper", {
                loop: true,
                effect: "fade",
                fadeEffect: {
                    crossFade: true,
                },
                speed: 800,
                grabCursor: true,
                keyboard: {
                    enabled: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                on: {
                    init: function () {
                        // Initialize progress bar
                        progressBar(this);
                    },
                    slideChange: function () {
                        // Update slide information
                        updateSlideInfo(this);
                    },
                },
                a11y: {
                    prevSlideMessage: "Previous slide",
                    nextSlideMessage: "Next slide",
                    firstSlideMessage: "This is the first slide",
                    lastSlideMessage: "This is the last slide",
                },
            });

            // Progress bar functionality
            function progressBar(slider) {
                const progressBar = document.querySelector(
                    ".swiper-progress-bar .progress"
                );
                let autoplayTime = slider.params.autoplay.delay;
                let progressBarWidth = 0;

                function moveProgressBar() {
                    progressBarWidth = 0;
                    progressBar.style.width = "0%";

                    const autoplayInterval = setInterval(function () {
                        progressBarWidth += 100 / (autoplayTime / 100);
                        progressBar.style.width = progressBarWidth + "%";

                        if (progressBarWidth >= 100) {
                            clearInterval(autoplayInterval);
                        }
                    }, 100);
                }

                // Initialize progress bar
                moveProgressBar();

                // Update on slide change
                slider.on("slideChange", function () {
                    moveProgressBar();
                });

                // Handle pause on hover
                const sliderEl = document.querySelector(".mySwiper");
                sliderEl.addEventListener("mouseenter", function () {
                    slider.autoplay.stop();
                    clearInterval(autoplayInterval);
                });

                sliderEl.addEventListener("mouseleave", function () {
                    slider.autoplay.start();
                    moveProgressBar();
                });
            }

            // Update slide information
            function updateSlideInfo(slider) {
                const activeSlide = slider.slides[slider.activeIndex];
                console.log(`Current slide: ${activeSlide.dataset.slideTitle}`);
            }

            // Add keyboard support
            document.addEventListener("keydown", function (e) {
                if (e.key === "ArrowRight") {
                    mainSwiper.slideNext();
                } else if (e.key === "ArrowLeft") {
                    mainSwiper.slidePrev();
                }
            });

            // Add swipe indicator on mobile
            if (window.innerWidth < 768) {
                const swipeIndicator = document.createElement("div");
                swipeIndicator.className = "swipe-indicator";
                swipeIndicator.innerHTML = `
                    <div class="fixed bottom-20 left-1/2 transform -translate-x-1/2 bg-black/60 text-white px-4 py-2 rounded-full text-sm flex items-center z-50 pointer-events-none opacity-80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        Swipe to navigate
                    </div>
                `;
                document.body.appendChild(swipeIndicator);

                setTimeout(() => {
                    swipeIndicator.style.opacity = "0";
                    swipeIndicator.style.transition = "opacity 0.5s ease";
                    setTimeout(() => {
                        swipeIndicator.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>

    <body class="bg-white text-gray-800 antialiased flex flex-col min-h-screen">

        <x-sub-header :store="$store" />
        <div class="flex-grow">
            {{ $slot }}
        </div>

        <x-footer :store="$store" />
        @livewireScripts @fluxScripts
    </body>
</html>
