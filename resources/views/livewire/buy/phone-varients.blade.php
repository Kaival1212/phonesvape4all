<section class="bg-white dark:bg-gray-900 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Product Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $product->name }}
            </h1>
            <p class="text-gray-600 dark:text-gray-300 mt-2 max-w-3xl">
                {{ $product->description }}
            </p>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Images -->
            <div class="lg:col-span-7 space-y-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm">
                    <img
                        src="{{ Storage::disk('r2')->url($this->selectedVariantDetails->image ?? $product->image) }}"
                        alt="{{ $this->selectedVariantDetails->variant_name }}"
                        class="w-full max-h-[500px] object-contain rounded-xl transition-all duration-300"
                    />
                </div>

                <div class="grid grid-cols-5 gap-2">
                    @foreach ($product->variants as $variant)
                    @if($variant->image)
                    <div
                        wire:click="$set('selectedVariant', {{ $variant->id }})"
                        class="cursor-pointer overflow-hidden rounded-lg
                                    {{ $selectedVariant === $variant->id
                                        ? 'ring-2 ring-blue-500'
                                        : 'ring-1 ring-gray-300 dark:ring-gray-700' }}"
                    >
                        <img
                            src="{{ Storage::disk('r2')->url($variant->image) }}"
                            alt="{{ $variant->variant_name }}"
                            class="w-full h-20 object-cover"
                        />
                    </div>
                    @endif @endforeach
                </div>
            </div>

            <!-- Purchase Panel -->
            <div class="lg:col-span-5">
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm sticky top-20 space-y-6"
                >
                    <div>
                        <h2
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            {{ $this->selectedVariantDetails->variant_name }}
                        </h2>
                        <p class="text-blue-600 text-2xl font-bold mt-2">
                            £{{ number_format($this->selectedVariantDetails->price, 2) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            SKU: #{{ $this->selectedVariantDetails->id }}
                        </p>
                    </div>

                    <!-- Variant List -->
                    <div class="mt-6 space-y-4">
                        @foreach ($productVarients as $variant)
                        <div
                            wire:click="$set('selectedVariant', {{ $variant->id }})"
                            class="cursor-pointer px-4 py-3 rounded-lg border transition-all duration-200
                                    {{ $selectedVariant === $variant->id
                                        ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20'
                                        : 'border-gray-200 dark:border-gray-700' }}"
                        >
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-gray-800 dark:text-white font-medium"
                                >
                                    {{ $variant->variant_name }}
                                </span>
                                <span
                                    class="text-blue-600 dark:text-blue-400 font-bold"
                                >
                                    £{{ number_format($variant->price, 2) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label
                            class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block"
                        >
                            Quantity
                        </label>
                        <div class="flex items-center">
                            <button
                                wire:click="decrementQuantity"
                                type="button"
                                class="w-10 h-10 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-l flex items-center justify-center"
                            >
                                −
                            </button>
                            <input
                                type="text"
                                value="{{ $quantity }}"
                                class="w-12 text-center bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white"
                                readonly
                            />
                            <button
                                wire:click="incrementQuantity"
                                type="button"
                                class="w-10 h-10 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-r flex items-center justify-center"
                            >
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="grid gap-4">
                        <button
                            wire:click="buyNow"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg transition"
                        >
                            Buy Now
                        </button>
                    </div>

                    @if (session()->has('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session("success") }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
