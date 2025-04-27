<?php

namespace App\Models;

use App\Mail\ConfirmBuying;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class SellBooking extends Model
{
    /** @use HasFactory<\Database\Factories\SellBookingFactory> */
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'store_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_city',
        'customer_state',
        'customer_zip',
        'customer_country',
        'customer_message',
        'status',
        'price',
        'discount',
        'total',
        'payment_status',
        'payment_method'
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public static function booted(){

        static::creating(function ($model) {
            $model->status = 'pending';
            $model->payment_status = 'pending';
        });

        static::created(function ($model) {
            Mail::to($model->customer_email)->send(new ConfirmBuying($model));
        });

        static::updating(function ($model) {
            if ($model->isDirty('discount') && $model->discount > 0 && $model->isDirty('total')) {
                Mail::to($model->customer_email)->send(new ConfirmBuying($model));
            }
        });

    }
}




// $table->id();
// $table->foreignId('product_variant_id')->constrained()->onDelete('cascade');
// $table->foreignID('store_id')->constrained()->onDelete('cascade');
// $table->string('customer_name');
// $table->string('customer_email');
// $table->string('customer_phone');
// $table->string('customer_address')->nullable();
// $table->string('customer_city')->nullable();
// $table->string('customer_state')->nullable();
// $table->string('customer_zip')->nullable();
// $table->string('customer_country')->nullable();
// $table->string('customer_message')->nullable();
// $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending');
// $table->decimal('price', 8, 2)->nullable();
// $table->decimal('discount', 8, 2)->nullable();
// $table->decimal('total', 8, 2)->nullable();
// $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
// $table->enum('payment_method', ['cash', 'card', 'stripe'])->nullable();
// $table->timestamps();
