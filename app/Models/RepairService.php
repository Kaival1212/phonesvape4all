<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairService extends Model
{
    /** @use HasFactory<\Database\Factories\RepairServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'price',
        'estimated_duration_minutes',
        'image',
    ];

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
