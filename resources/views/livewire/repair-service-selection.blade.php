<!-- Product Repair Page -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-black">
                {{ $product->name }} Repairs
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                {{ $product->description }}
            </p>
        </div>

        <!-- Product Image -->
        <div class="flex justify-center mb-10">
            <img
                src="{{ Storage::disk('r2')->url($product->image) }}"
                alt="{{ $product->name }}"
                class="w-52 sm:w-64 rounded-xl shadow-lg"
            />
        </div>

        @if($services->count() > 0)
        <!-- Repair Services Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($services as $service)
            <div
                class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-xl transition-all duration-300"
            >
                @if ($service->image)
                <div class="w-full h-40 mb-4 overflow-hidden rounded-lg">
                    <img
                        src="{{ Storage::disk('r2')->url($service->image) }}"
                        alt="{{ $service->name }}"
                        class="w-full h-full object-cover"
                    />
                </div>
                @endif

                <h3 class="text-xl font-semibold text-black mb-2">
                    {{ $service->name }}
                </h3>

                @if ($service->description)
                <p class="text-gray-600 mb-2 text-sm">
                    {{ $service->description }}
                </p>
                @endif

                <div class="text-black font-medium text-lg mb-1">
                    £{{ number_format($service->price, 2) }}
                </div>

                @if ($service->estimated_duration_minutes)
                <div class="text-sm text-gray-600 mb-4">
                    Est. Duration:
                    {{ $service->estimated_duration_minutes }} mins
                </div>
                @endif

                <a
                    href="{{ route('repair.product.form.service', [$categoriesSlug, $brandSlug, $productID, $service->id]) }}"
                    class="inline-block bg-black hover:bg-gray-800 text-white text-sm py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition"
                >
                    Book Now
                </a>
            </div>
            @endforeach
        </div>
        @else
        <!-- Model Number Form -->
        <div class="max-w-md mx-auto">
            <div
                class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm"
            >
                <h3 class="text-xl font-semibold text-black mb-4">
                    Enter Your Device Details
                </h3>
                <p class="text-gray-600 mb-6">
                    Please provide your device's model number to proceed with
                    the repair booking.
                </p>

                <form wire:submit.prevent="submitModelNumber" class="space-y-4">
                    <div>
                        <label
                            for="model_number"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Model Number
                        </label>
                        <input
                            type="text"
                            id="model_number"
                            wire:model="modelNumber"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black"
                            placeholder="Enter your device model number"
                            required
                            @disabled($isSubmitting)
                        />
                        @error('modelNumber')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-black hover:bg-gray-800 text-white py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition"
                        @disabled($isSubmitting)
                    >
                        @if($isSubmitting)
                        <span class="inline-flex items-center">
                            <svg
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Processing...
                        </span>
                        @else Continue to Booking @endif
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</section>
