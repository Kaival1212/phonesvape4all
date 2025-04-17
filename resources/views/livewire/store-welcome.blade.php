<x-layouts.app
    :title="$store->meta_title"
    :description="$store->meta_description"
    :image="optional($store->image) ? asset('storage/' . $store->image) : null"
    :store="$store"
>
    <x-image-slider class="max-h-[70vh] overflow-hidden" />

    <!-- Hero Section -->
    <section
        class="bg-white dark:bg-gray-800 py-16 px-4 sm:px-6 border-b border-gray-200 dark:border-gray-700"
    >
        <!-- Welcome Message -->
        <div class="container mx-auto text-center max-w-3xl mb-12">
            <h1
                class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 dark:text-white"
            >
                Welcome to {{ $store->name }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Your one-stop destination for tech repairs and cutting-edge
                devices
            </p>
        </div>

        <!-- Services Highlights -->
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Fix Your Device -->
            <a
                href="{{ route('repair') }}"
                class="group block bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <div class="flex justify-center mb-6">
                    <img src={{
                        asset("storage/images/fix-device.png")
                    }}
                    alt="Fix Your Device" class="h-20 w-20 drop-shadow-sm
                    group-hover:scale-105 transition" />
                </div>
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition text-center"
                >
                    Fix Your Device
                </h3>
                <p class="mt-3 text-gray-600 dark:text-gray-300 text-center">
                    Fast, reliable repair services for phones, tablets &
                    computers with same-day solutions.
                </p>
            </a>

            <!-- Buy a New Device -->
            <a
                href="/shop"
                class="group block bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <div class="flex justify-center mb-6">
                    <img src={{
                        asset("storage/images/buy-device.png")
                    }}
                    alt="Buy a New Device" class="h-20 w-20 drop-shadow-sm
                    group-hover:scale-105 transition" />
                </div>
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition text-center"
                >
                    Buy a New Device
                </h3>
                <p class="mt-3 text-gray-600 dark:text-gray-300 text-center">
                    Explore our premium selection of brand-new and certified
                    refurbished devices.
                </p>
            </a>

            <!-- Sell a Device -->
            <a
                href="/sell"
                class="group block bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <div class="flex justify-center mb-6">
                    <img src={{
                        asset("storage/images/sell-device.png")
                    }}
                    alt="Sell a Device" class="h-20 w-20 drop-shadow-sm
                    group-hover:scale-105 transition" />
                </div>
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition text-center"
                >
                    Sell a Device
                </h3>
                <p class="mt-3 text-gray-600 dark:text-gray-300 text-center">
                    Trade in or sell your old phone for instant cash or store
                    credit at competitive rates.
                </p>
            </a>
        </div>
    </section>

    <!-- Repair Services Section -->
    <section class="py-16 px-4 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <span
                    class="inline-block px-4 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium mb-4"
                    >EXPERT SERVICES</span
                >
                <h2
                    class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-white"
                >
                    Phone Repairing and Device Management
                </h2>
                <p
                    class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto"
                >
                    All devices undergo comprehensive diagnostic checks to
                    identify issues and provide tailored solutions with
                    precision and care.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 items-start">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-3xl mb-3">🔧</div>
                        <h4
                            class="font-semibold text-lg mb-2 text-gray-900 dark:text-white"
                        >
                            Broken Screen or Touch
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            We fix cracked screens, LCD discoloration, and
                            chipped glasses — usually within 24 hours with
                            premium parts.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-3xl mb-3">🔌</div>
                        <h4
                            class="font-semibold text-lg mb-2 text-gray-900 dark:text-white"
                        >
                            Charging Port or IC Replacement
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            Whether it's a broken charging port or a faulty IC,
                            we offer fast and reliable power management
                            solutions.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-3xl mb-3">🔍</div>
                        <h4
                            class="font-semibold text-lg mb-2 text-gray-900 dark:text-white"
                        >
                            Face ID, Dot Projector, or Micro Soldering
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            We provide expert micro soldering services to fix
                            Face ID, motherboard, CPU, and other complex
                            hardware issues.
                        </p>
                    </div>
                </div>

                <!-- Middle Image -->
                <div class="flex justify-center items-center">
                    <img
                        src="{{ asset('storage/images/bg-2.webp') }}"
                        alt="Repair Services"
                        class="rounded-lg border border-gray-200 dark:border-gray-700 w-full max-w-sm object-cover transform hover:scale-105 transition duration-500"
                    />
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-3xl mb-3">💧</div>
                        <h4
                            class="font-semibold text-lg mb-2 text-gray-900 dark:text-white"
                        >
                            Water Damage
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            We diagnose and repair water-damaged devices with
                            industry-leading success rates and meticulous care.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-3xl mb-3">📸</div>
                        <h4
                            class="font-semibold text-lg mb-2 text-gray-900 dark:text-white"
                        >
                            Back Glass & Camera Lens
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            From cracked back glass to damaged camera lenses, we
                            replace them with premium-grade OEM-quality parts.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-3xl mb-3">🔋</div>
                        <h4
                            class="font-semibold text-lg mb-2 text-gray-900 dark:text-white"
                        >
                            Battery Replacements
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            Fast, affordable battery replacements for all major
                            phone and tablet models with performance guarantees.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-16 px-4 bg-white dark:bg-gray-800">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <span
                    class="inline-block px-4 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium mb-4"
                    >LATEST UPDATES</span
                >
                <h2
                    class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-white"
                >
                    Phones & Vapes Blog
                </h2>
                <p
                    class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto"
                >
                    Stay updated with our latest news, tech tips, and industry
                    insights
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Blog Card 1 -->
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <div class="overflow-hidden h-56">
                        <img
                            src="https://phonesvapes4all.co.uk/assets/front/images/blog1.png"
                            alt="Corporate Orders"
                            class="w-full h-full object-cover transition transform hover:scale-105"
                        />
                    </div>
                    <div class="p-6">
                        <span
                            class="inline-block px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium mb-4"
                            >BUSINESS</span
                        >
                        <h3
                            class="text-lg font-bold mb-3 text-gray-900 dark:text-white"
                        >
                            Corporate Orders & Discounts
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            We provide exclusive corporate deals for repair and
                            unlocking services, including bulk device orders
                            with priority service.
                        </p>
                    </div>
                </div>

                <!-- Blog Card 2 -->
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <div class="overflow-hidden h-56">
                        <img
                            src="https://phonesvapes4all.co.uk/assets/front/images/blog2.png"
                            alt="Success Story"
                            class="w-full h-full object-cover transition transform hover:scale-105"
                        />
                    </div>
                    <div class="p-6">
                        <span
                            class="inline-block px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium mb-4"
                            >SUCCESS</span
                        >
                        <h3
                            class="text-lg font-bold mb-3 text-gray-900 dark:text-white"
                        >
                            Rising to the Challenge
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            We thrive in competition and specialize in turning
                            "dead" devices into functional assets with our
                            expert technicians.
                        </p>
                    </div>
                </div>

                <!-- Blog Card 3 -->
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:border-blue-500 dark:hover:border-blue-500 transition transform hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <div class="overflow-hidden h-56">
                        <img
                            src="https://phonesvapes4all.co.uk/assets/front/images/blog3.png"
                            alt="Tech Expertise"
                            class="w-full h-full object-cover transition transform hover:scale-105"
                        />
                    </div>
                    <div class="p-6">
                        <span
                            class="inline-block px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium mb-4"
                            >EXPERTISE</span
                        >
                        <h3
                            class="text-lg font-bold mb-3 text-gray-900 dark:text-white"
                        >
                            Tech Expertise: Android, iOS, and More
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            From unlocking and software reinstalls to secure
                            data recovery, we offer expert services across all
                            major platforms.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <!-- <section
        class="py-16 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white"
    >
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">
                Ready to Fix or Upgrade Your Device?
            </h2>
            <p
                class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto"
            >
                Get in touch with our expert team today for fast, reliable
                service and the best deals on new and refurbished devices.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a
                    href="/services/repair"
                    class="px-6 py-3 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Book a Repair
                </a>
                <a
                    href="/contact"
                    class="px-6 py-3 rounded-lg bg-transparent border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-bold hover:border-blue-600 dark:hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 transition transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Contact Us
                </a>
            </div>
        </div>
    </section> -->
</x-layouts.app>
