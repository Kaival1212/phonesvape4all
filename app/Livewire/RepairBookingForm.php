<?php

namespace App\Livewire;

use App\Models\RepairBooking;
use App\Models\RepairService;
use App\Models\Store;
use Livewire\Component;
use Carbon\Carbon;

class RepairBookingForm extends Component
{
    public $service;

    public $name;
    public $email;
    public $phone;
    public $selectedDate;
    public $selectedTime;
    public $timeSlots = [];
    public $store_id;
    public $stores;

    public $notes;

    public function mount($categoriesSlug, $brandSlug, $productID, $repairServiceID)
    {
        $this->service = RepairService::findOrFail($repairServiceID);
        $this->stores = Store::all();
    }

    public function updatedSelectedDate($value)
    {
        $this->generateTimeSlots($value);
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

    public function submit()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'selectedDate' => 'required|date|after_or_equal:today',
            'selectedTime' => 'required',
            'store_id' => 'required|exists:stores,id',
        ]);

        $bookingID = RepairBooking::create([
            'repair_service_id' => $this->service->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'selected_date' => $this->selectedDate,
            'selected_time' => $this->selectedTime,
            'store_id' => $this->store_id,
            'notes' => $this->notes,
            //'status' => 'pending',
            'price' => $this->service->price,
            //'currency' => $this->service->currency,
        ])->id;



        session()->flash('success', 'Your booking has been submitted!');

        $this->reset(['name', 'email', 'phone', 'selectedDate', 'selectedTime', 'timeSlots' , "store_id"]);
    }

    public function render()
    {
        return view('livewire.repair-booking-form');
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
