<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function brands() {
        return $this->hasMany(Brand::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

}


// public function up(): void
// {
//     Schema::create('categories', function (Blueprint $table) {
//         $table->id();
//         $table->string('name');
//         $table->string('slug')->unique();
//         $table->string('image')->nullable();
//         $table->timestamps();
//     });
// }
