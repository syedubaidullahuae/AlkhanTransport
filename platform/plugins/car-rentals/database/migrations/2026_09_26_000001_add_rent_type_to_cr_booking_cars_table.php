<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cr_booking_cars', function (Blueprint $table) {
            $table->string('rent_type', 20)->nullable()->after('no_of_months');
        });
    }

    public function down(): void
    {
        Schema::table('cr_booking_cars', function (Blueprint $table) {
            $table->dropColumn('rent_type');
        });
    }
};