<!-- Product Repair Page -->
<section class="bg-gradient-to-br from-gray-50 to-white py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-black mb-4">
                {{ $product->name }} Repairs
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ $product->description }}
            </p>
        </div>

        <!-- Product Image -->
        <div class="flex justify-center mb-16">
            <div class="relative">
                @if($product->image)
                    <img
                        src="{{ Storage::disk('r2')->url($product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-64 sm:w-80 rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-300"
                    />
                @else
                    <div class="w-64 sm:w-80 h-64 sm:h-80 bg-gray-200 rounded-2xl flex items-center justify-center shadow-2xl">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif
                <div class="absolute -top-4 -right-4 bg-black text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                    Expert Repair
                </div>
            </div>
        </div>

        @if($services->count() > 0)
            <!-- Repair Services Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($services as $service)
                    <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col h-[420px]">
                        @if ($service->image)
                            <div class=" w-full h-full overflow-hidden">
                                <img
                                    src="{{ Storage::disk('r2')->url($service->image) }}"
                                    alt="{{ $service->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6 flex flex-col justify-between flex-1">
                            <div>
                                <h3 class="text-xl font-bold text-black mb-3 group-hover:text-gray-800 transition-colors">
                                    {{ $service->name }}
                                </h3>

                                @if ($service->description)
                                    <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-2">
                                        {{ $service->description }}
                                    </p>
                                @endif

                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-black font-bold text-2xl">
                                        £{{ number_format($service->price, 2) }}
                                    </div>
                                    @if ($service->estimated_duration_minutes)
                                        <div class="flex items-center text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $service->estimated_duration_minutes }} mins
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <a href="{{ route('repair.product.form.service', [$categoriesSlug, $brandSlug, $productID, $service->id]) }}"
                            class="block w-full bg-black hover:bg-gray-800 text-white text-center font-semibold py-3 px-6 rounded-xl focus:outline-none focus:ring-4 focus:ring-black/20 transition-all duration-200 transform hover:scale-105 active:scale-95"
                            >
                            Book Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Model Number Form -->
            <div class="max-w-lg mx-auto">
                <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-xl">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-black rounded-full mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-black mb-2">
                            Enter Your Device Details
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            Please provide your device's model number to proceed with the repair booking.
                        </p>
                    </div>

                    <form wire:submit.prevent="submitModelNumber" class="space-y-6">
                        <div>
                            <label
                                for="model_number"
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Model Number
                            </label>
                            <input
                                type="text"
                                id="model_number"
                                wire:model="modelNumber"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-200 text-lg"
                                placeholder="Enter your device model number"
                                required
                                @disabled($isSubmitting)
                            />
                            @error('modelNumber')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-4 px-6 rounded-xl focus:outline-none focus:ring-4 focus:ring-black/20 transition-all duration-200 transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
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
                            @else
                                <span class="flex items-center justify-center">
                            Continue to Booking
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</section>
