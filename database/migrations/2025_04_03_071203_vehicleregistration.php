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
        Schema::create('vehicleregistarions', function (Blueprint $table) {
            // Remove $table->id() if you want registration_number as primary key
            $table->string('registration_number')->primary(); // Set as primary key
            
            $table->string('vehicle_type');
            $table->integer('seating_capacity');
            $table->string('make');
            $table->string('model'); // Changed from integer to string
            $table->integer('year');
            $table->boolean('is_active')->default(true);
            $table->boolean('scheduled')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicleregistrations');
    }
};