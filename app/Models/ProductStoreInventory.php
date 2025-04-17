<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStoreInventory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductStoreInventoryFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'store_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

// $table->foreignId('product_id')->constrained()->onDelete('cascade');
// $table->foreignId('store_id')->constrained()->onDelete('cascade');
// $table->unsignedInteger('quantity')->default(0);
