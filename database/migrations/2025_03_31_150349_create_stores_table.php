<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Store name
            $table->string('slug')->unique();        // SEO-friendly slug
            $table->string('address');               // Full address
            $table->string('city')->nullable();      // City for local SEO
            $table->string('postcode')->nullable();  // Useful for maps
            $table->string('phone')->nullable();     // Customer support
            $table->string('email')->nullable();     // Contact email
            $table->string('google_maps_link')->nullable(); // Link to store on Google Maps
            $table->string('image')->nullable();     // Store image
            $table->text('meta_title')->nullable();  // SEO title
            $table->text('meta_description')->nullable(); // SEO description
            $table->json('opening_hours')->nullable(); // Store opening hours (JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
