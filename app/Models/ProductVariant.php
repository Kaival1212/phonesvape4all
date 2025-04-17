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
}


// Schema::create('product_variants', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('product_id')->constrained()->onDelete('cascade');
//     $table->string('variant_name'); // e.g., 128GB Black
//     $table->decimal('price', 8, 2)->nullable();
//     $table->string('sku')->nullable();
//     $table->timestamps();
// });
