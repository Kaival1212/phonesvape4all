<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('repair_booking_services', function (Blueprint $table) {
            // Since we already added model_number in the create migration, we don't need to add it again
            // But we'll ensure the price, discount, and total columns are nullable
            $table->decimal('price', 10, 2)->nullable()->change();
            $table->decimal('discount', 10, 2)->nullable()->change();
            $table->decimal('total', 10, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('repair_booking_services', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable(false)->change();
            $table->decimal('discount', 10, 2)->nullable(false)->change();
            $table->decimal('total', 10, 2)->nullable(false)->change();
        });
    }
};
