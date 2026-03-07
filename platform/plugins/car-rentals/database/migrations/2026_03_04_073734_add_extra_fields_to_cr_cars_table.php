<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cr_cars', function (Blueprint $table) {

            $table->integer('luggage_capacity')->nullable()->after('number_of_doors');
            $table->decimal('monthly_rent', 12, 2)->nullable()->after('rental_rate');
            

        });
    }

    public function down(): void
    {
        Schema::table('cr_cars', function (Blueprint $table) {
            $table->dropColumn([
                'luggage_capacity',
                'monthly_rent',
                'no_of_months',
            ]);
        });
    }
};