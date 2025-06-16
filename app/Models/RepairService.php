<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RepairService extends Model
{
    /** @use HasFactory<\Database\Factories\RepairServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'estimated_duration_minutes',
        'image',
        'product_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_repair_service');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

// $table->foreignId('product_id')->constrained()->onDelete('cascade');
// $table->string('name'); // e.g., Screen Repair
// $table->text('description')->nullable();
// $table->decimal('price', 8, 2);
// $table->integer('estimated_duration_minutes')->nullable();
