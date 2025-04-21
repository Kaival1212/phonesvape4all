<div class="max-w-2xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8">
        <flux:heading size="xl" class="mb-4">
            Book a Repair for {{ $service->name }}
        </flux:heading>

        <flux:text class="mb-8 text-gray-600 dark:text-gray-300">
            Please fill out your details and preferred time to schedule your
            repair appointment.
        </flux:text>

        <form wire:submit.prevent="submit" class="space-y-6">
            <!-- Name -->
            <flux:field>
                <flux:label badge="Required">Full Name</flux:label>
                <flux:input
                    type="text"
                    wire:model.defer="name"
                    placeholder="John Doe"
                    required
                />
                <flux:error name="name" />
            </flux:field>

            <!-- Email -->
            <flux:field>
                <flux:label badge="Required">Email</flux:label>
                <flux:input
                    type="email"
                    wire:model.defer="email"
                    placeholder="you@example.com"
                    required
                />
                <flux:error name="email" />
            </flux:field>

            <!-- Phone -->
            <flux:field>
                <flux:label badge="Required">Phone Number</flux:label>
                <flux:input
                    type="tel"
                    wire:model.defer="phone"
                    placeholder="+44 7123 456789"
                    required
                />
                <flux:text class="text-xs text-gray-500 mt-1">
                    Please include your country code (e.g. +44 for UK)
                </flux:text>
                <flux:error name="phone" />
            </flux:field>

            <!-- Notes -->
            <flux:field>
                <flux:label badge="Optional">Notes</flux:label>
                <flux:textarea
                    wire:model.defer="notes"
                    placeholder="Optional notes about your issue..."
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
                    class="mt-1 block w-full rounded-md p-2 border border-gray-300"
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
                />
                <flux:error name="selectedDate" />
            </flux:field>

            <!-- Time -->
            @if (!empty($timeSlots))
            <flux:field>
                <flux:label badge="Required">Preferred Time</flux:label>
                <select
                    wire:model.defer="selectedTime"
                    class="mt-1 block w-full rounded-md border border-gray-300 dark:bg-gray-700 dark:text-white"
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
            <div class="pt-4">
                <flux:button type="submit" variant="primary" class="w-full">
                    Confirm Booking
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
