<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairBooking extends Model
{
    /** @use HasFactory<\Database\Factories\RepairBookingFactory> */
    use HasFactory;

    protected $fillable = [
        'repair_service_id',
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
        'price',
        'currency',
        'store_id'
    ];
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
