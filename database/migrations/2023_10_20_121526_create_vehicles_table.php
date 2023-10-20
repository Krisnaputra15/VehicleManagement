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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['suv', 'sedan', 'pickup', 'bus', 'motor']);
            $table->string('serie');
            $table->year('year');
            $table->string('license_number', 20);
            $table->integer('fuel_capacity');
            $table->integer('service_cycle');
            $table->boolean('need_service')->default(false);
            $table->boolean('is_booked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
