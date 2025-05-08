<div class="bg-gray-900">
    <!-- Enhanced Slider Section -->
    <div class="relative">
        <!-- Main Slider -->
        <div class="swiper mySwiper w-full max-h-[600px] md:max-h-[700px]">
            <div class="swiper-wrapper">
                <!-- Phone Repair Slide -->
                <div
                    class="swiper-slide relative"
                    data-slide-title="Phone Repairs"
                >
                    <div class="w-full h-[600px] md:h-[700px] bg-gray-900">
                        <div
                            class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1616348436168-de43ad0db179?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80')] bg-cover bg-center opacity-75"
                        ></div>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-transparent"
                    >
                        <div
                            class="absolute bottom-0 left-0 p-8 md:p-16 text-white max-w-2xl"
                        >
                            <h2 class="text-4xl md:text-6xl font-bold mb-4">
                                Expert Phone Repairs
                            </h2>
                            <p class="text-lg md:text-xl mb-8 text-gray-200">
                                Fast, reliable repairs for all your devices with
                                same-day service available
                            </p>
                            <a
                                href="{{ route('repair') }}"
                                class="inline-block px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition transform hover:-translate-y-1"
                            >
                                Book a Repair
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Buy Devices Slide -->
                <div
                    class="swiper-slide relative"
                    data-slide-title="Buy Devices"
                >
                    <div class="w-full h-[600px] md:h-[700px] bg-gray-900">
                        <div
                            class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1598327105666-5b89351aff97?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2072&q=80')] bg-cover bg-center opacity-75"
                        ></div>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-transparent"
                    >
                        <div
                            class="absolute bottom-0 left-0 p-8 md:p-16 text-white max-w-2xl"
                        >
                            <h2 class="text-4xl md:text-6xl font-bold mb-4">
                                Premium Devices
                            </h2>
                            <p class="text-lg md:text-xl mb-8 text-gray-200">
                                Explore our selection of new and certified
                                refurbished devices
                            </p>
                            <a
                                href="{{ route('buy') }}"
                                class="inline-block px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition transform hover:-translate-y-1"
                            >
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sell Devices Slide -->
                <div
                    class="swiper-slide relative"
                    data-slide-title="Sell Devices"
                >
                    <div class="w-full h-[600px] md:h-[700px] bg-gray-900">
                        <div
                            class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1607083206968-13611e3d76db?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')] bg-cover bg-center opacity-75"
                        ></div>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-transparent"
                    >
                        <div
                            class="absolute bottom-0 left-0 p-8 md:p-16 text-white max-w-2xl"
                        >
                            <h2 class="text-4xl md:text-6xl font-bold mb-4">
                                Sell Your Device
                            </h2>
                            <p class="text-lg md:text-xl mb-8 text-gray-200">
                                Get instant cash or store credit for your old
                                devices
                            </p>
                            <a
                                href="/sell"
                                class="inline-block px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition transform hover:-translate-y-1"
                            >
                                Sell Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Navigation Controls -->
            <div
                class="swiper-button-next !hidden md:!flex !text-white !right-8 !w-12 !h-12 !bg-black/30 !rounded-full after:!text-2xl hover:!bg-black/50 transition"
            ></div>
            <div
                class="swiper-button-prev !hidden md:!flex !text-white !left-8 !w-12 !h-12 !bg-black/30 !rounded-full after:!text-2xl hover:!bg-black/50 transition"
            ></div>

            <!-- Custom Pagination -->
            <div class="swiper-pagination !bottom-8"></div>
        </div>

        <!-- Progress Bar -->
        <div class="swiper-progress-bar">
            <span class="progress"></span>
        </div>
    </div>
</div>
