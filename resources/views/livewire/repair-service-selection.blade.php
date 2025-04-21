<!-- Product Repair Page -->
<section class="bg-white dark:bg-gray-900 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2
                class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white"
            >
                {{ $product->name }} Repairs
            </h2>
            <p
                class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto"
            >
                {{ $product->description }}
            </p>
        </div>

        <!-- Product Image -->
        <div class="flex justify-center mb-10">
            <img
                src="{{ env('R2_URL') . $product->image }}"
                alt="{{ $product->name }}"
                class="w-52 sm:w-64 rounded-xl shadow-lg"
            />
        </div>

        <!-- Repair Services Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($services as $service)
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-xl transition-all duration-300"
            >
                @if ($service->image)
                <div class="w-full h-40 mb-4 overflow-hidden rounded-lg">
                    <img
                        src="{{ env('R2_URL') . $service->image }}"
                        alt="{{ $service->name }}"
                        class="w-full h-full object-cover"
                    />
                </div>
                @endif

                <h3
                    class="text-xl font-semibold text-gray-900 dark:text-white mb-2"
                >
                    {{ $service->name }}
                </h3>

                @if ($service->description)
                <p class="text-gray-600 dark:text-gray-300 mb-2 text-sm">
                    {{ $service->description }}
                </p>
                @endif

                <div
                    class="text-gray-800 dark:text-white font-medium text-lg mb-1"
                >
                    £{{ number_format($service->price, 2) }}
                </div>

                @if ($service->estimated_duration_minutes)
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Est. Duration:
                    {{ $service->estimated_duration_minutes }} mins
                </div>
                @endif

                <flux:button
                    size="sm"
                    variant="primary"
                    href="{{ route('repair.product.form' , [$categoriesSlug , $brandSlug ,$productID , $service->id  ]) }}"
                    >Book Now</flux:button
                >
            </div>
            @endforeach
        </div>
    </div>
</section>
