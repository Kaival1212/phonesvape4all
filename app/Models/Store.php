<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'city',
        'postcode',
        'phone',
        'email',
        'google_maps_link',
        'image',
        'meta_title',
        'meta_description',
        'opening_hours',
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'product_store_inventory')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function sellBookings()
    {
        return $this->hasMany(\App\Models\SellBooking::class);
    }

    public function repairBookings()
    {
        return $this->hasMany(\App\Models\RepairBooking::class);
    }

}



// Schema::create('stores', function (Blueprint $table) {
//     $table->id();
//     $table->string('name');                  // Store name
//     $table->string('slug')->unique();        // SEO-friendly slug
//     $table->string('address');               // Full address
//     $table->string('city')->nullable();      // City for local SEO
//     $table->string('postcode')->nullable();  // Useful for maps
//     $table->string('phone')->nullable();     // Customer support
//     $table->string('email')->nullable();     // Contact email
//     $table->string('google_maps_link')->nullable(); // Link to store on Google Maps
//     $table->string('image')->nullable();     // Store image
//     $table->text('meta_title')->nullable();  // SEO title
//     $table->text('meta_description')->nullable(); // SEO description
//     $table->json('opening_hours')->nullable(); // Store opening hours (JSON)
//     $table->timestamps();
// });
