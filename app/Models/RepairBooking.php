<?php

namespace App\Models;

use App\Mail\RepairAppoinmentBooked;
use App\Mail\ThanksForRepairPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class RepairBooking extends Model
{
    /** @use HasFactory<\Database\Factories\RepairBookingFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'selected_date',
        'selected_time',
        'status',
        'notes',
        'payment_status',
        'payment_method',
        'transaction_id',
        'total_amount',
        'total_discount',
        'final_amount',
        'currency',
        'store_id',
        'product_id',
        'address',
        'city',
        'postcode'
    ];

    protected static function booted()
    {
        static::created(function ($repairBooking) {
            $email = $repairBooking->email;
            Mail::to($email)->send(new RepairAppoinmentBooked($repairBooking));
        });

        static::updated(function ($repairBooking) {
            if ($repairBooking->isDirty('payment_status') && $repairBooking->payment_status == 'paid') {
                $email = $repairBooking->email;
                Mail::to($email)->send(new ThanksForRepairPayment($repairBooking));
            }
        });
    }

    public function repairServices()
    {
        return $this->belongsToMany(RepairService::class, 'repair_booking_services')
            ->withPivot(['price', 'discount', 'total'])
            ->withTimestamps();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateTotals()
    {
        $totalAmount = $this->repairServices->sum('pivot.price');
        $totalDiscount = $this->repairServices->sum('pivot.discount');
        $finalAmount = $totalAmount - $totalDiscount;

        $this->update([
            'total_amount' => $totalAmount,
            'total_discount' => $totalDiscount,
            'final_amount' => $finalAmount
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
