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
        Schema::create('cargo_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->decimal('base_fare', 10, 2);
            
            // Vehicle reference
            $table->string('vehicle_id');
           
            
            // Days and Time
            $table->json('shipment_days')->nullable();
            $table->time('departure_time')->nullable();
            
            $table->timestamps();
            $table->unique(['departure_city', 'arrival_city', 'vehicle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_routes');
    }
};
