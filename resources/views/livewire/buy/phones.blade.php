<!-- Shop Product Display Section -->
<section class="bg-white py-16 border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-black">
                Phones in Stock
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Browse our latest collection of new and refurbished smartphones.
            </p>
        </div>

        <!-- Search Input -->
        <div class="max-w-xl mx-auto mb-10">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search for a phone..."
                class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-black bg-white text-black placeholder-gray-500 transition"
            />
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($products as $product)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-xl transition duration-300 flex flex-col" style="height: 480px;">
                    <div class="relative bg-gray-50 flex items-center justify-center p-4" style="height: 280px;">
                        <img
                            src="{{ Storage::disk('r2')->url($product->image) }}"
                            alt="{{ $product->name }}"
                            class="max-w-full max-h-full object-contain rounded-lg"
                        />
                        @if($product->is_repairable)
                            <span class="absolute top-2 left-2 bg-black text-white text-xs px-2 py-1 rounded-full shadow">
                        Repairable
                    </span>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col justify-between" style="height: 200px;">
                        <div>
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-xl font-bold text-black leading-tight flex-grow pr-2">
                                    {{ $product->name }}
                                </h3>
                                <span class="text-sm text-gray-600 font-medium whitespace-nowrap">
                                {{ $product->brand->name }}
                            </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                {{ $product->description }}
                            </p>
                        </div>
                        <div class="text-center">
                            <a
                                href="{{ route('buy.phones.variants', [$categoriesSlug, $brandSlug, $product->id]) }}"
                                class="inline-block bg-black hover:bg-gray-800 text-white text-sm font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition-all duration-200 w-full"
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
