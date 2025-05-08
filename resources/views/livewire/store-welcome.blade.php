<x-layouts.app
    :title="$store->meta_title"
    :description="$store->meta_description"
    :image="optional($store->image) ? asset('storage/' . $store->image) : null"
    :store="$store"
>
    <x-image-slider />

    <!-- Hero Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-black">
                    Expert Phone & Device Repairs
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Fast, reliable repairs for all your devices. Same-day
                    service available.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a
                        href="{{ route('repair') }}"
                        class="px-8 py-4 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition transform hover:-translate-y-1"
                    >
                        Book a Repair
                    </a>
                    <a
                        href="{{ route('buy') }}"
                        class="px-8 py-4 bg-white text-black font-semibold rounded-lg border border-black hover:bg-gray-100 transition transform hover:-translate-y-1"
                    >
                        Buy a Device
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-black">Our Services</h2>
                <p class="text-xl text-gray-600">
                    Professional repairs for all your devices
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Repair -->
                <div
                    class="bg-white rounded-xl p-8 text-center hover:transform hover:-translate-y-2 transition duration-300 shadow-lg"
                >
                    <div
                        class="w-20 h-20 mx-auto mb-6 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="repair" class="w-10 h-10 text-white" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-black">Repair</h3>
                    <p class="text-gray-600 mb-6">
                        Expert repairs for phones, tablets, and laptops with
                        same-day service available.
                    </p>
                    <a
                        href="{{ route('repair') }}"
                        class="inline-block px-6 py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition"
                    >
                        Book Now
                    </a>
                </div>

                <!-- Buy -->
                <div
                    class="bg-white rounded-xl p-8 text-center hover:transform hover:-translate-y-2 transition duration-300 shadow-lg"
                >
                    <div
                        class="w-20 h-20 mx-auto mb-6 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="phone" class="w-10 h-10 text-white" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-black">Buy</h3>
                    <p class="text-gray-600 mb-6">
                        Premium selection of new and certified refurbished
                        devices with warranty.
                    </p>
                    <a
                        href="{{ route('buy') }}"
                        class="inline-block px-6 py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition"
                    >
                        Shop Now
                    </a>
                </div>

                <!-- Sell -->
                <div
                    class="bg-white rounded-xl p-8 text-center hover:transform hover:-translate-y-2 transition duration-300 shadow-lg"
                >
                    <div
                        class="w-20 h-20 mx-auto mb-6 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="sell" class="w-10 h-10 text-white" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-black">Sell</h3>
                    <p class="text-gray-600 mb-6">
                        Get instant cash or store credit for your old devices at
                        competitive rates.
                    </p>
                    <a
                        href="/sell"
                        class="inline-block px-6 py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition"
                    >
                        Sell Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-black">
                    Why Choose Us?
                </h2>
                <p class="text-xl text-gray-600">
                    Experience the best in device repair and service
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="fast" class="w-8 h-8 text-white" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-black">
                        Fast Service
                    </h3>
                    <p class="text-gray-600">Same-day repairs available</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="warranty" class="w-8 h-8 text-white" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-black">Warranty</h3>
                    <p class="text-gray-600">90-day warranty on all repairs</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="expert" class="w-8 h-8 text-white" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-black">
                        Expert Techs
                    </h3>
                    <p class="text-gray-600">Certified technicians</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-black rounded-full flex items-center justify-center"
                    >
                        <x-icons name="quality" class="w-8 h-8 text-white" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-black">
                        Quality Parts
                    </h3>
                    <p class="text-gray-600">OEM quality components</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6 text-black">
                Ready to Fix Your Device?
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                Book your repair today and experience our professional service
            </p>
            <a
                href="{{ route('repair') }}"
                class="inline-block px-8 py-4 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition transform hover:-translate-y-1"
            >
                Book a Repair
            </a>
        </div>
    </section>
</x-layouts.app>
