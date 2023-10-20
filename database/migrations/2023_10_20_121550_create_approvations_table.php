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
        Schema::create('approvations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('approver_id', 36);
            $table->char('transaction_id', 36);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('approver_id')->references('id')->on('users')->onUpdate('CASCADE');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvations');
    }
};
