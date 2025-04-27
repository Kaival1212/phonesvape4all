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

        @session('success')
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session("success") }}
        </div>
        @endsession

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

                    <!-- Actions -->
                    <div class="grid gap-4">
                        <flux:modal.trigger name="buying-modal">
                            <button
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition"
                            >
                                Buy Now
                            </button>
                        </flux:modal.trigger>

                        <flux:modal name="buying-modal" class="md:w-96">
                            <flux:heading>Confirm Purchase</flux:heading>

                            <form
                                wire:submit.prevent="buyNow"
                                class="space-y-4"
                            >
                                <!-- Pickup Store -->
                                <flux:field>
                                    <flux:label>Pickup Store</flux:label>
                                    <flux:select wire:model.defer="storeId">
                                        <option value="" disabled>
                                            Select a store…
                                        </option>
                                        @foreach($availabeStores as $inv)
                                        <option value="{{ $inv->store_id }}">
                                            {{ $inv->store->name }}
                                            @if($inv->quantity >= 1) – same day
                                            pick up @else – pick up tomorrow
                                            @endif
                                        </option>
                                        @endforeach
                                    </flux:select>
                                    <flux:error name="storeId" />
                                </flux:field>

                                <!-- Your Name -->
                                <flux:field>
                                    <flux:label>Your Name</flux:label>
                                    <flux:input
                                        wire:model.defer="customerName"
                                        type="text"
                                        placeholder="John Smith"
                                    />
                                    <flux:error name="customerName" />
                                </flux:field>

                                <!-- Email Address -->
                                <flux:field>
                                    <flux:label>Email Address</flux:label>
                                    <flux:input
                                        wire:model.defer="customerEmail"
                                        type="email"
                                        placeholder="you@example.com"
                                    />
                                    <flux:error name="customerEmail" />
                                </flux:field>

                                <!-- Phone Number -->
                                <flux:field>
                                    <flux:label>Phone Number</flux:label>
                                    <flux:input
                                        wire:model.defer="customerPhone"
                                        type="tel"
                                        placeholder="07123 456789"
                                    />
                                    <flux:error name="customerPhone" />
                                </flux:field>

                                <!-- Payment Method -->
                                <!-- <flux:field>
                                    <flux:label>Payment Method</flux:label>
                                    <flux:select
                                        wire:model.defer="paymentMethod"
                                    >
                                        <option value="" disabled>
                                            Choose one…
                                        </option>
                                        <option value="card">Card</option>
                                        <option value="stripe">Stripe</option>
                                        <option value="bank_transfer">
                                            Bank Transfer
                                        </option>
                                        <option value="cash">Cash</option>
                                    </flux:select>
                                    <flux:error name="paymentMethod" />
                                </flux:field> -->

                                <flux:button
                                    type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition"
                                >
                                    Confirm Purchase
                                </flux:button>
                            </form>
                        </flux:modal>
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
