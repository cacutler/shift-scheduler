<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(); // For relating an assigned shift to a specific employee
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date'); // For when a shift is an overnight shift and ends on next day, if applicable
            $table->time('end_time');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('shifts');
    }
};