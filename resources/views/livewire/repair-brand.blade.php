<!-- Brands Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-black">
                Popular Brands
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Browse devices from your favorite manufacturers
            </p>
        </div>

        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6"
        >
            @foreach($brands as $brand)
            <a
                href="{{ route('repair.product', [$category->slug, $brand->slug]) }}"
                class="group flex flex-col items-center bg-white border border-gray-200 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
            >
                <div
                    class="w-24 h-24 sm:w-28 sm:h-28 mb-4 flex items-center justify-center"
                >
                    <img
                        src="{{ Storage::disk('r2')->url($brand->image) }}"
                        alt="{{ $brand->name }} logo"
                        class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300"
                    />
                </div>
                <h3
                    class="text-base sm:text-lg font-semibold text-black group-hover:text-gray-600 transition-colors"
                >
                    {{ $brand->name }}
                </h3>
            </a>
            @endforeach
        </div>
    </div>
</section>
