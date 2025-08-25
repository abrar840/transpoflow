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
        Schema::create('cargo_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained(); // Booking agent
            $table->string('tracking_number')->unique();
            
            // Shipper Info
            $table->string('shipper_name');
            $table->string('shipper_phone');
            $table->text('shipper_address');
            $table->string('shipper_city');
            
            // Consignee Info
            $table->string('consignee_name');
            $table->string('consignee_phone');
            $table->text('consignee_address');
            $table->string('consignee_city');
            
            // Shipment Details
            $table->decimal('weight', 10, 2); // kg
            $table->decimal('volume', 10, 2); // cm³
            $table->string('item_description');
            $table->integer('quantity');
            
            // Pricing
            $table->decimal('base_fare', 10, 2);
            $table->decimal('weight_charge', 10, 2);
            $table->decimal('volume_charge', 10, 2);
            $table->decimal('service_charge', 10, 2);
            $table->decimal('total_amount', 10, 2);
            
            // Status
            $table->enum('status', ['pending', 'dispatched', 'in_transit', 'delivered','canceled'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_bookings');
    }
};
