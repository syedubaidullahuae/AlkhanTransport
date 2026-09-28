<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cr_booking_cars', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_type_id')->nullable()->after('car_id');
        });
    }

    public function down(): void
    {
        Schema::table('cr_booking_cars', function (Blueprint $table) {
            $table->dropColumn('vehicle_type_id');
        });
    }
};