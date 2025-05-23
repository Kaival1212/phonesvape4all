<!-- Product Display Section -->
<section class="bg-white py-16 border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-black">
                Available Products
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Browse our selection of repairable devices
            </p>
        </div>

        <!-- Search Input -->
        <div class="max-w-xl mx-auto mb-10">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search for a product..."
                class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-black bg-white text-black placeholder-gray-500 transition"
            />
        </div>

        <!-- Products Grid -->
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
            @foreach($products as $product)
            <div
                class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-xl transition duration-300"
            >
                <div class="relative">
                    <img
                        src="{{ Storage::disk('r2')->url($product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                    />
                    @if($product->is_repairable)
                    <span
                        class="absolute top-2 right-2 bg-black text-white text-xs px-2 py-1 rounded-full shadow"
                    >
                        Repairable
                    </span>
                    @endif
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-semibold text-black">
                            {{ $product->name }}
                        </h3>
                        <span class="text-sm text-gray-600">
                            {{ $product->brand->name }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                        {{ $product->description }}
                    </p>
                    <div class="text-center">
                        <a
                            href="{{ route('repair.service.selection', [$categoriesSlug, $brandSlug, $product->id]) }}"
                            class="inline-block bg-black hover:bg-gray-800 text-white text-sm py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition"
                        >
                            Book Repair
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
