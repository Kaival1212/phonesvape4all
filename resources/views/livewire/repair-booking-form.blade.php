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
