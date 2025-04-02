<div class="bg-white text-gray-900">
    <!-- Enhanced Slider Section -->
    <div class="relative">
        <!-- Main Slider -->
        <div class="swiper mySwiper w-full max-h-[450px] md:max-h-[600px]">
            <div class="swiper-wrapper">
                <div
                    class="swiper-slide relative"
                    data-slide-title="First Slide"
                >
                    <img
                        src="https://fakeimg.pl/2500x1000/111111/"
                        class="w-full h-full object-cover rounded-b-lg"
                        alt="First slide description"
                        loading="eager"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"
                    >
                        <div
                            class="absolute bottom-0 left-0 p-4 md:p-8 text-white"
                        >
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">
                                First Slide Title
                            </h2>
                            <p
                                class="hidden md:block text-sm md:text-base mb-4"
                            >
                                Brief description of the first slide content
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="swiper-slide relative"
                    data-slide-title="Second Slide"
                >
                    <img
                        src="https://fakeimg.pl/2500x1000/ff0000/"
                        class="w-full h-full object-cover rounded-b-lg"
                        alt="Second slide description"
                        loading="lazy"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"
                    >
                        <div
                            class="absolute bottom-0 left-0 p-4 md:p-8 text-white"
                        >
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">
                                Second Slide Title
                            </h2>
                            <p
                                class="hidden md:block text-sm md:text-base mb-4"
                            >
                                Brief description of the second slide content
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="swiper-slide relative"
                    data-slide-title="Third Slide"
                >
                    <img
                        src="https://fakeimg.pl/2500x1000/00ff00/"
                        class="w-full h-full object-cover rounded-b-lg"
                        alt="Third slide description"
                        loading="lazy"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"
                    >
                        <div
                            class="absolute bottom-0 left-0 p-4 md:p-8 text-white"
                        >
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">
                                Third Slide Title
                            </h2>
                            <p
                                class="hidden md:block text-sm md:text-base mb-4"
                            >
                                Brief description of the third slide content
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Navigation Controls -->
            <div
                class="swiper-button-next !hidden md:!flex !text-white !right-4 !w-10 !h-10 !bg-black/30 !rounded-full after:!text-xl"
            ></div>
            <div
                class="swiper-button-prev !hidden md:!flex !text-white !left-4 !w-10 !h-10 !bg-black/30 !rounded-full after:!text-xl"
            ></div>

            <!-- Custom Pagination -->
            <div class="swiper-pagination !bottom-4"></div>
        </div>

        <!-- Thumbnails (Visible on larger screens)
        <div
            class="hidden lg:block swiper-thumbs max-w-screen-xl mx-auto px-4 -mt-12 relative z-10"
        >
            <div class="swiper thumbSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide cursor-pointer p-1">
                        <div class="bg-white rounded-lg p-2 shadow-md">
                            <div
                                class="w-full h-16 bg-gray-900 rounded flex items-center justify-center text-white text-sm"
                            >
                                First Slide
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide cursor-pointer p-1">
                        <div class="bg-white rounded-lg p-2 shadow-md">
                            <div
                                class="w-full h-16 bg-red-600 rounded flex items-center justify-center text-white text-sm"
                            >
                                Second Slide
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide cursor-pointer p-1">
                        <div class="bg-white rounded-lg p-2 shadow-md">
                            <div
                                class="w-full h-16 bg-green-600 rounded flex items-center justify-center text-white text-sm"
                            >
                                Third Slide
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Progress Bar -->
        <div class="swiper-progress-bar">
            <span class="progress"></span>
        </div>
    </div>
</div>
