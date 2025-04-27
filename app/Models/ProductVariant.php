<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_name',
        'price',
        'sku',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stock(){
        return $this->hasMany(ProductStoreInventory::class, 'product_variant_id');
    }

    public static function booted(){
        static::created(function ($productVariant) {

            $stores = Store::all();
            foreach ($stores as $store) {

                $productVariant->stock()->create([
                    'store_id' => $store->id,
                    'quantity' => 0,
                    'product_variant_id' => $productVariant->id
                ]);
            }

        });
    }

    // public function getDisplayNameAttribute()
// {
//     return "{$this->variant_name} – {$this->product->name}";
// }
}


// Schema::create('product_variants', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('product_id')->constrained()->onDelete('cascade');
//     $table->string('variant_name'); // e.g., 128GB Black
//     $table->decimal('price', 8, 2)->nullable();
//     $table->string('sku')->nullable();
//     $table->timestamps();
// });
