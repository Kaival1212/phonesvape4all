<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\RepairService;
use App\Models\Store;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RepairBookingForm extends Component
{
    public $product;
    public $service;
    public $productID;
    public $serviceID;
    public $categoriesSlug;
    public $brandSlug;
    public $modelNumber;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $store_id;
    public $selectedDate;
    public $selectedTime;
    public $selectedServices = [];
    public $modelNumbers = [];
    public Collection $services;
    public $timeSlots = [];
    public $totalAmount = 0;
    public $totalDiscount = 0;
    public $finalAmount = 0;
    public $hasRepairServices = false;
    public $serviceType = 'in_store'; // Default to in-store
    public $address;
    public $city;
    public $postcode;

    public function mount($categoriesSlug, $brandSlug, $productID, $serviceID = null)
    {
        $this->product = Product::findOrFail($productID);
        $this->productID = $productID;
        $this->categoriesSlug = $categoriesSlug;
        $this->brandSlug = $brandSlug;

        // Get repair services for this product
        $this->services = RepairService::where('product_id', $productID)->get();
        $this->hasRepairServices = $this->services->isNotEmpty();

        // Handle model number from URL if product has no repair services
        if (!$this->hasRepairServices) {
            $this->modelNumber = request()->query('model_number');
        }
        // Handle service selection if product has repair services
        else if ($serviceID && !is_string($serviceID)) {
            $this->serviceID = $serviceID;
            $this->service = RepairService::find($serviceID);
            if ($this->service) {
                $this->selectedServices[] = $this->service->id;
                $this->calculateTotals();
            }
        }
    }

    public function updatedSelectedServices()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totalAmount = 0;
        $this->totalDiscount = 0;

        foreach ($this->selectedServices as $serviceId) {
            $service = $this->services->firstWhere('id', $serviceId);
            if ($service) {
                $this->totalAmount += $service->price;
                $this->totalDiscount += $service->discount ?? 0;
            }
        }

        $this->finalAmount = $this->totalAmount - $this->totalDiscount;
    }

    public function updatedSelectedDate($value)
    {
        if ($value) {
            $this->generateTimeSlots($value);
        }
    }

    public function generateTimeSlots($date)
    {
        $day = Carbon::parse($date)->dayOfWeek;
        $start = $day === 0 ? '10:30' : '09:00';
        $end = $day === 0 ? '17:00' : '19:00';

        $startTime = Carbon::createFromFormat('H:i', $start);
        $endTime = Carbon::createFromFormat('H:i', $end);
        $slots = [];

        while ($startTime <= $endTime) {
            $slots[] = $startTime->format('H:i');
            $startTime->addMinutes(30);
        }

        $this->timeSlots = $slots;
    }

    public function updatedServiceType($value)
    {
        // Reset address fields if switching to in-store
        if ($value === 'in_store') {
            $this->address = null;
            $this->city = null;
            $this->postcode = null;
        }
    }

    public function submit()
    {
        // Base validation rules
        $rules = [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'store_id' => 'required|exists:stores,id',
            'selectedDate' => 'required|date|after_or_equal:today',
            'selectedTime' => 'required|string',
            'serviceType' => 'required|in:in_store,doorstep,pickup',
        ];

        // Add address validation for doorstep and pickup
        if (in_array($this->serviceType, ['doorstep', 'pickup'])) {
            $rules['address'] = 'required|string|min:5';
            $rules['city'] = 'required|string|min:2';
            $rules['postcode'] = 'required|string|min:5';
        }

        // Add specific validation rules based on repair service availability
        if ($this->hasRepairServices) {
            $rules['selectedServices'] = 'required|array|min:1';
            $rules['modelNumbers.*'] = 'required_if:selectedServices.*,true|string|min:3';
        } else {
            $rules['modelNumber'] = 'required|string|min:3';
        }

        $this->validate($rules);

        // Prevent duplicate bookings for the same customer, store, date, and time
        $existing = $this->product->repairBookings()
            ->where('email', $this->email)
            ->where('store_id', $this->store_id)
            ->where('selected_date', $this->selectedDate)
            ->where('selected_time', $this->selectedTime)
            ->first();

        if ($existing) {
            session()->flash('error', 'A booking already exists for this customer at the selected time.');
            return;
        }

        // Create the booking
        $booking = $this->product->repairBookings()->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'store_id' => $this->store_id,
            'selected_date' => $this->selectedDate,
            'selected_time' => $this->selectedTime,
            'status' => 'pending',
            'payment_status' => 'pending',
            'total_amount' => $this->totalAmount,
            'total_discount' => $this->totalDiscount,
            'final_amount' => $this->finalAmount,
            'currency' => 'GBP',
            'service_type' => $this->serviceType,
            'address' => $this->address,
            'city' => $this->city,
            'postcode' => $this->postcode,
        ]);

        if ($this->hasRepairServices) {
            // Add selected services to the booking
            foreach ($this->selectedServices as $serviceId) {
                $service = $this->services->firstWhere('id', $serviceId);
                if ($service) {
                    $booking->repairServices()->attach($service->id, [
                        'price' => $service->price,
                        'discount' => $service->discount ?? 0,
                        'total' => $service->price - ($service->discount ?? 0),
                        'model_number' => $this->modelNumbers[$serviceId] ?? null
                    ]);
                }
            }
        } else {
            // Create a custom repair service entry for products without predefined services
            $booking->repairServices()->attach(null, [
                'model_number' => $this->modelNumber,
                'price' => null,
                'discount' => null,
                'total' => null
            ]);
        }

        session()->flash('success', 'Your repair booking has been submitted successfully!');
        return redirect()->route('repair.booking.confirmation', $booking->id);
    }

    public function render()
    {
        return view('livewire.repair-booking-form', [
            'stores' => Store::all()
        ]);
    }
}


// $table->id();

// $table->foreignId('repair_service_id')->constrained('repair_services')->onDelete('cascade');
// $table->string('name');
// $table->string('email');
// $table->string('phone');
// $table->date('selected_date');
// $table->time('selected_time');
// $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
// $table->text('notes')->nullable();
// $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
// $table->enum('payment_method', ['card', 'stripe', 'bank_transfer' , 'cash'])->nullable();
// $table->string('transaction_id')->nullable();

// $table->double('price');
// $table->string('currency')->default('GBP');

// $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');

// $table->timestamps();
