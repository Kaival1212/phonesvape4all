<div class="max-w-2xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <flux:heading size="xl" class="mb-4 text-black">
            Book a Repair
        </flux:heading>

        <flux:text class="mb-8 text-gray-600">
            Please fill out your details to schedule your repair appointment.
        </flux:text>

        <form wire:submit.prevent="submit" class="space-y-6">
            @if($hasRepairServices)
            <!-- Services Selection -->
            <flux:field>
                <flux:label badge="Required">Select Services</flux:label>
                <div class="space-y-4">
                    @foreach($services as $service)
                    <div
                        class="flex items-center space-x-4 p-4 border rounded-lg hover:bg-gray-50 transition"
                    >
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <input
                                    type="checkbox"
                                    wire:model.live="selectedServices"
                                    value="{{ $service->id }}"
                                    id="service-{{ $service->id }}"
                                    class="rounded border-gray-300 text-black shadow-sm focus:border-black focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                                />
                                <label
                                    for="service-{{ $service->id }}"
                                    class="font-medium text-black"
                                >
                                    {{ $service->name }}
                                </label>
                            </div>
                            @if($service->description)
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $service->description }}
                            </p>
                            @endif @if(in_array($service->id, $selectedServices)
                            && is_null($service->price))
                            <div class="mt-2">
                                <label
                                    class="block text-xs font-semibold mb-1 text-black"
                                >
                                    Model Number
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    wire:model.defer="modelNumbers.{{ $service->id }}"
                                    class="w-full rounded border-gray-300 p-2 focus:border-black focus:ring focus:ring-gray-200"
                                    placeholder="Enter model number"
                                    required
                                />
                                @error('modelNumbers.' . $service->id)
                                <span class="text-xs text-red-600">{{
                                    $message
                                }}</span>
                                @enderror
                            </div>
                            @endif
                        </div>
                        <div class="text-right">
                            @if(!is_null($service->price))
                            <p class="font-medium text-black">
                                £{{ number_format($service->price, 2) }}
                            </p>
                            @if($service->discount)
                            <p class="text-sm text-red-600">
                                -£{{ number_format($service->discount, 2) }}
                            </p>
                            @endif @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <flux:error name="selectedServices" />
            </flux:field>

            <!-- Total Summary -->
            @if(count($selectedServices) > 0)
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-medium mb-4 text-black">
                    Booking Summary
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal:</span>
                        <span>£{{ number_format($totalAmount, 2) }}</span>
                    </div>
                    @if($totalDiscount > 0)
                    <div class="flex justify-between text-red-600">
                        <span>Discount:</span>
                        <span>-£{{ number_format($totalDiscount, 2) }}</span>
                    </div>
                    @endif
                    <div
                        class="flex justify-between font-medium border-t pt-2 mt-2 text-black"
                    >
                        <span>Total:</span>
                        <span>£{{ number_format($finalAmount, 2) }}</span>
                    </div>
                </div>
            </div>
            @endif @else
            <!-- Model Number Input for Products without Services -->
            <flux:field>
                <flux:label badge="Required">Model Number</flux:label>
                <flux:input
                    wire:model.defer="modelNumber"
                    placeholder="Enter your device model number"
                    required
                    class="focus:border-black focus:ring focus:ring-gray-200"
                />
                <flux:error name="modelNumber" />
                <p class="mt-2 text-sm text-gray-600">
                    Please provide your device's model number so we can better
                    assist you with the repair.
                </p>
            </flux:field>
            @endif

            <!-- Service Type Selection -->
            <flux:field>
                <flux:label badge="Required">Service Type</flux:label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                    <!-- In-Store Repair -->
                    <label class="relative flex flex-col items-center p-4 border rounded-xl cursor-pointer transition-all duration-200 hover:shadow-lg hover:border-black {{ $serviceType === 'in_store' ? 'border-black bg-gray-50' : 'border-gray-200' }}">
                        <input type="radio" wire:model.live="serviceType" value="in_store" class="sr-only">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">In-Store Repair</span>
                        <span class="text-xs text-gray-500 mt-1">Visit our store for repair</span>
                    </label>

                    <!-- Doorstep Repair -->
                    <label class="relative flex flex-col items-center p-4 border rounded-xl cursor-pointer transition-all duration-200 hover:shadow-lg hover:border-black {{ $serviceType === 'doorstep' ? 'border-black bg-gray-50' : 'border-gray-200' }}">
                        <input type="radio" wire:model.live="serviceType" value="doorstep" class="sr-only">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Doorstep Repair</span>
                        <span class="text-xs text-gray-500 mt-1">We come to your location</span>
                    </label>

                    <!-- Pick-up & Drop-off -->
                    <label class="relative flex flex-col items-center p-4 border rounded-xl cursor-pointer transition-all duration-200 hover:shadow-lg hover:border-black {{ $serviceType === 'pickup' ? 'border-black bg-gray-50' : 'border-gray-200' }}">
                        <input type="radio" wire:model.live="serviceType" value="pickup" class="sr-only">
                        <div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Pick-up & Drop-off</span>
                        <span class="text-xs text-gray-500 mt-1">We collect and return your device</span>
                    </label>
                </div>
                <flux:error name="serviceType" />
            </flux:field>

            <!-- Address Fields (shown for doorstep and pickup) -->
            @if(in_array($serviceType, ['doorstep', 'pickup']))
            <div class="space-y-6">
                <flux:field>
                    <flux:label badge="Required">Delivery Address</flux:label>
                    <div class="space-y-4">
                        <flux:input
                            wire:model.defer="address"
                            placeholder="Street address"
                            required
                            class="focus:border-black focus:ring focus:ring-gray-200"
                        />
                        <flux:error name="address" />

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <flux:input
                                    wire:model.defer="city"
                                    placeholder="City"
                                    required
                                    class="focus:border-black focus:ring focus:ring-gray-200"
                                />
                                <flux:error name="city" />
                            </div>
                            <div>
                                <flux:input
                                    wire:model.defer="postcode"
                                    placeholder="Postcode"
                                    required
                                    class="focus:border-black focus:ring focus:ring-gray-200"
                                />
                                <flux:error name="postcode" />
                            </div>
                        </div>
                    </div>
                </flux:field>
            </div>
            @endif

            <!-- Customer Information -->
            <flux:field>
                <flux:label badge="Required">Name</flux:label>
                <flux:input
                    wire:model.defer="name"
                    placeholder="Your full name"
                    required
                    class="focus:border-black focus:ring focus:ring-gray-200"
                />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label badge="Required">Email</flux:label>
                <flux:input
                    type="email"
                    wire:model.defer="email"
                    placeholder="Your email address"
                    required
                    class="focus:border-black focus:ring focus:ring-gray-200"
                />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label badge="Required">Phone</flux:label>
                <flux:input
                    type="tel"
                    wire:model.defer="phone"
                    placeholder="Your phone number"
                    required
                    class="focus:border-black focus:ring focus:ring-gray-200"
                />
                <flux:error name="phone" />
            </flux:field>

            <flux:field>
                <flux:label badge="Optional">Notes</flux:label>
                <flux:textarea
                    wire:model.defer="notes"
                    placeholder="Optional notes about your issue..."
                    class="focus:border-black focus:ring focus:ring-gray-200"
                />
                <flux:error name="notes" />
            </flux:field>

            <!-- Store -->
            <flux:field>
                <flux:label badge="Required">Preferred Store</flux:label>
                <select
                    wire:model.defer="store_id"
                    id="store"
                    name="store"
                    class="mt-1 block w-full rounded-md p-2 border border-gray-300 focus:border-black focus:ring focus:ring-gray-200"
                    required
                >
                    <option value="">Select a store</option>
                    @foreach ($stores as $store)
                    <option value="{{ $store->id }}">
                        {{ $store->name }} - {{ $store->city }}
                    </option>
                    @endforeach
                </select>
                <flux:error name="store_id" />
            </flux:field>

            <!-- Date -->
            <flux:field>
                <flux:label badge="Required">Preferred Date</flux:label>
                <flux:input
                    type="date"
                    wire:model.live="selectedDate"
                    min="{{ now()->format('Y-m-d') }}"
                    required
                    class="focus:border-black focus:ring focus:ring-gray-200"
                />
                <flux:error name="selectedDate" />
            </flux:field>

            <!-- Time -->
            @if (!empty($timeSlots))
            <flux:field>
                <flux:label badge="Required">Preferred Time</flux:label>
                <select
                    wire:model.defer="selectedTime"
                    class="mt-1 block w-full rounded-md p-2 border border-gray-300 focus:border-black focus:ring focus:ring-gray-200"
                    required
                >
                    <option value="">Select a time</option>
                    @foreach ($timeSlots as $slot)
                    <option value="{{ $slot }}">{{ $slot }}</option>
                    @endforeach
                </select>
                <flux:error name="selectedTime" />
            </flux:field>
            @endif

            <!-- Submit Button -->
            <div class="mt-6">
                <flux:button
                    type="submit"
                    wire:click="submit"
                    class="w-full bg-black hover:bg-gray-800 text-white"
                    :disabled="$hasRepairServices && count($selectedServices) === 0"
                >
                    Book Appointment
                </flux:button>
            </div>
        </form>

        @if (session()->has('success'))
        <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session("success") }}
        </div>
        @endif
    </div>
</div>
