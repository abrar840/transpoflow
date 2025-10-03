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
            
            $table->string('ticket_number')->unique();
        
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('vehicle_schedules');
        
            $table->string('vehicle_id'); // FK to vehicles.registration_number
        
            $table->string('passenger_name');
            $table->string('passenger_cnic')->nullable();
            $table->string('passenger_phone');
            $table->string('passenger_gender')->nullable();
        
            $table->date('travel_date');
        
            // Fare info
            $table->decimal('fare', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
        
            $table->date('valid_until');
            $table->string('status')->default('confirmed');
            $table->dateTime('booking_date');
        
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('transaction_id')->nullable();

        
            $table->timestamps();
        
            // Indexes
            $table->index('ticket_number');
            $table->index('user_id');
            $table->index('travel_date');
            $table->index('status');
            

        });
        
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
        Schema::dropIfExists('tickets');
    }
};
