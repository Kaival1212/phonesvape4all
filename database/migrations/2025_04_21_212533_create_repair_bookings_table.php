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
        Schema::create('repair_bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('repair_service_id')->constrained('repair_services')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('selected_date');
            $table->time('selected_time');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('payment_method', ['card', 'stripe', 'bank_transfer' , 'cash'])->nullable();
            $table->string('transaction_id')->nullable();

            $table->double('price');
            $table->double('discount')->nullable();
            $table->double('total')->nullable();
            $table->string('currency')->default('GBP');

            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_bookings');
    }
};
