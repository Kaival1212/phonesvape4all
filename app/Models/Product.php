<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'image',
        'slug',
        'description',
        'is_selling',
        'is_repairable',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function repairServices() {
        return $this->hasMany(RepairService::class);
    }

    public function stores() {
        return $this->belongsToMany(Store::class, 'product_store_inventory')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

}


// Schema::create('products', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('category_id')->constrained()->onDelete('cascade');
//     $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
//     $table->string('name');
//     $table->string('slug')->unique();
//     $table->text('description')->nullable();
//     $table->boolean('is_selling')->default(true);
//     $table->boolean('is_repairable')->default(false);
//     $table->timestamps();
// });
