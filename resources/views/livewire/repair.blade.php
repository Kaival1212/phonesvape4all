<!-- Device Category Section -->
<section
    class="bg-white dark:bg-gray-900 py-16 border-b border-gray-200 dark:border-gray-700"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2
                class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white"
            >
                Choose Your Device Category
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Select your device type to begin booking a repair service.
            </p>
        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
            @foreach($categories as $category)
            <a
                href="{{ route('repair.category', $category->slug) }}"
                class="group block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1"
            >
                <div class="relative">
                    <img
                        src="{{ env('R2_URL') . $category->image }}"
                        alt="{{ $category->name }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                    />
                </div>
                <div class="p-4 text-center">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors"
                    >
                        {{ $category->name }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
