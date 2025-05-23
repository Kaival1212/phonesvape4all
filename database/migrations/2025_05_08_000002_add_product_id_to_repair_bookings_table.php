<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('repair_bookings', function (Blueprint $table) {
            $table->foreignId('product_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('repair_bookings', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
