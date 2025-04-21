<!-- Shop Product Display Section -->
<section
    class="bg-white dark:bg-gray-900 py-16 border-b border-gray-200 dark:border-gray-700"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Heading -->
        <div class="text-center mb-12">
            <h2
                class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white"
            >
                Phones in Stock
            </h2>
            <p
                class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto"
            >
                Browse our latest collection of new and refurbished smartphones.
            </p>
        </div>

        <!-- Search Input -->
        <div class="max-w-xl mx-auto mb-10">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search for a phone..."
                class="w-full px-5 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition"
            />
        </div>

        <!-- Products Grid -->
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
            @foreach($products as $product)
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden shadow hover:shadow-xl transition duration-300"
            >
                <div class="relative">
                    <img
                        src="{{ env('R2_URL') . $product->image }}"
                        alt="{{ $product->name }}"
                        class="w-full h-48 object-cover"
                    />
                    @if($product->is_repairable)
                    <span
                        class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow"
                    >
                        Repairable
                    </span>
                    @endif
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white"
                        >
                            {{ $product->name }}
                        </h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $product->brand->name }}
                        </span>
                    </div>
                    <p
                        class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2"
                    >
                        {{ $product->description }}
                    </p>
                    <div class="text-center">
                        <a
                            href=" {{ route('buy.phones.variants' , [ $categoriesSlug , $brandSlug , $product->id ]) }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >
                            View Product
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
