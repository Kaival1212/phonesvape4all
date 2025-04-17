<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

}


// public function up(): void
// {
//     Schema::create('brands', function (Blueprint $table) {
//         $table->id();
//         $table->foreignId('category_id')->constrained()->onDelete('cascade');
//         $table->string('name')->unique();
//         $table->string('slug')->unique();
//         $table->string('image')->nullable();
//         $table->timestamps();
//     });
// }
