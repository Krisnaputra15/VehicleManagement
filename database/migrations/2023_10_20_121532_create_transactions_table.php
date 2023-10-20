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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('driver_id');
            $table->uuid('vehicle_id');
            $table->integer('booking_duration');
            $table->date('booking_start');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->integer('distance_traveled');
            $table->integer('fuel_consumed');
            $table->boolean('is_returned')->default(false);
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('users')->onUpdate('CASCADE');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
