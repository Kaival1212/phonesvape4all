<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_booking_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('repair_service_id')->nullable()->constrained()->onDelete('set null');
            $table->string('model_number')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_booking_services');
    }
};
