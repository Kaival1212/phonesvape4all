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
            $table->decimal('total_amount', 10, 2); // Total amount for all services
            $table->decimal('total_discount', 10, 2)->nullable(); // Total discount for all services
            $table->decimal('final_amount', 10, 2); // Final amount after all discounts
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
