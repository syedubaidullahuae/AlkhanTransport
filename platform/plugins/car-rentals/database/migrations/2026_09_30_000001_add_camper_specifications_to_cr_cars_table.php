<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cr_cars', function (Blueprint $table): void {
            $table->unsignedSmallInteger('adult_passenger_capacity')->nullable();
            $table->unsignedSmallInteger('child_passenger_capacity')->nullable();
            $table->unsignedInteger('fresh_water_tank_capacity')->nullable();
            $table->boolean('has_private_shower_toilet')->default(false);
            $table->boolean('has_water_heater')->default(false);
            $table->boolean('has_kitchen_utensils')->default(false);
            $table->boolean('has_stove')->default(false);
            $table->boolean('has_fridge')->default(false);
            $table->boolean('has_sink')->default(false);
            $table->boolean('has_child_seatbelts')->default(false);
            $table->string('double_bed_dimensions', 50)->nullable();
            $table->string('single_convertible_sofa_bed_dimensions', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cr_cars', function (Blueprint $table): void {
            $table->dropColumn([
                'adult_passenger_capacity',
                'child_passenger_capacity',
                'fresh_water_tank_capacity',
                'has_private_shower_toilet',
                'has_water_heater',
                'has_kitchen_utensils',
                'has_stove',
                'has_fridge',
                'has_sink',
                'has_child_seatbelts',
                'double_bed_dimensions',
                'single_convertible_sofa_bed_dimensions',
            ]);
        });
    }
};