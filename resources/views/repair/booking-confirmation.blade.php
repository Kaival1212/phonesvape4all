<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold text-green-600 mb-2">
                            Booking Confirmed!
                        </h1>
                        <p class="text-gray-600">
                            Your repair booking has been successfully submitted.
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            Booking Details
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">
                                    Booking Reference
                                </p>
                                <p class="font-medium">
                                    #{{ $repairBooking->id }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <p class="font-medium capitalize">
                                    {{ $repairBooking->status }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Date</p>
                                <p class="font-medium">
                                    {{ $repairBooking->selected_date }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Time</p>
                                <p class="font-medium">
                                    {{ $repairBooking->selected_time }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Store</p>
                                <p class="font-medium">
                                    {{ $repairBooking->store->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Product</p>
                                <p class="font-medium">
                                    {{ $repairBooking->product->name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            Customer Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Name</p>
                                <p class="font-medium">
                                    {{ $repairBooking->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium">
                                    {{ $repairBooking->email }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Phone</p>
                                <p class="font-medium">
                                    {{ $repairBooking->phone }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($repairBooking->notes)
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            Additional Notes
                        </h2>
                        <p class="text-gray-700">{{ $repairBooking->notes }}</p>
                    </div>
                    @endif

                    <div class="text-center mt-8">
                        <a
                            href="{{ route('home') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                        >
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
