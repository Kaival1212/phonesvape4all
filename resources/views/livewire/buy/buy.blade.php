<!-- Buy Phone Category Section -->
<section
    class="bg-white dark:bg-gray-900 py-16 border-b border-gray-200 dark:border-gray-700"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Heading -->
        <div class="text-center mb-12">
            <h2
                class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white"
            >
                Shop by Device Category
            </h2>
            <p
                class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto"
            >
                Discover our range of smartphones and gadgets. Choose your
                device category to explore available phones.
            </p>
        </div>

        <!-- Category Cards -->
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
        >
            @foreach($categories as $category)
            <a
                href="{{ route('buy.category', $category->slug) }}"
                class="group block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 hover:ring-2 hover:ring-blue-500"
            >
                <div class="relative">
                    <img
                        src="{{ Storage::disk('r2')->url($category->image) }}"
                        alt="{{ $category->name }}"
                        class="w-full h-full object-fill object-center transition-transform duration-300 group-hover:scale-105"
                        />
                    <div
                        class="absolute top-2 right-2 bg-blue-100 text-blue-600 text-xs font-semibold px-2 py-1 rounded"
                    >
                        Explore
                    </div>
                </div>

                <div class="p-5 text-center">
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors"
                    >
                        {{ $category->name }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Latest deals and top models
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
