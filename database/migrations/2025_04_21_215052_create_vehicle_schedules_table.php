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
        Schema::create('vehicle_schedules', function (Blueprint $table) {
            $table->id();
            
            // For route_id (assuming routes uses id as PK)
            $table->unsignedBigInteger('route_id');
            
            // For vehicle_id - matches vehicles.registration_number type
            $table->string('vehicle_id'); 
            
            $table->json('days_of_week');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->timestamps();
            
            // Foreign key for route
            $table->foreign('route_id')
                  ->references('id')
                  ->on('routes')
                  ->onDelete('cascade');
                  
            // Foreign key for vehicle - referencing registration_number
            $table->foreign('vehicle_id')
                  ->references('registration_number')
                  ->on('vehicles')
                  ->onDelete('cascade');
            
            $table->unique(['route_id', 'vehicle_id', 'departure_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_schedules');
    }
};
