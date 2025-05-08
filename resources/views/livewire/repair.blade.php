<!-- Device Category Section -->
<section class="bg-white py-16 border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-black">
                Choose Your Device Category
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Select your device type to begin booking a repair service.
            </p>
        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
            @foreach($categories as $category)
            <a
                href="{{ route('repair.category', $category->slug) }}"
                class="group block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1"
            >
                <div class="relative">
                    <img
                        src="{{ Storage::disk('r2')->url($category->image) }}"
                        alt="{{ $category->name }}"
                        class="w-full h-full object-fill object-center transition-transform duration-300 group-hover:scale-105"
                    />
                </div>
                <div class="p-4 text-center">
                    <h3
                        class="text-lg font-semibold text-black group-hover:text-gray-600 transition-colors"
                    >
                        {{ $category->name }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
