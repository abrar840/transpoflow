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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            
            // Ticket identification
            $table->string('ticket_number')->unique();
            
            // Relationships
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
            
            // Changed to string to match vehicles.registration_number type
            $table->string('vehicle_id');
            
            // Passenger information
            $table->string('passenger_name');
            $table->string('passenger_cnic')->nullable();
            $table->string('passenger_phone');
            $table->string('passenger_email')->nullable();
            $table->string('passenger_gender')->nullable();
            
            // Travel information
            $table->date('travel_date');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('seat_number');
            
            // Fare information
            $table->decimal('fare', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            
            // Ticket validity
            $table->date('valid_until');
            
            // Status and tracking
            $table->string('status')->default('confirmed');
            $table->dateTime('booking_date');
            
            // Payment information
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('transaction_id')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('ticket_number');
            $table->index('user_id');
            $table->index('company_id');
            $table->index('route_id');
            $table->index('vehicle_id');
            $table->index('status');
            $table->index('travel_date');
        });

        // Add the foreign key constraint separately after table creation
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('vehicle_id')
                  ->references('registration_number')
                  ->on('vehicles')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });
        
        Schema::dropIfExists('tickets');
    }
};