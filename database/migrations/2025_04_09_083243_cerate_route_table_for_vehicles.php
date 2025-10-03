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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->string('vehicle_type');
            $table->decimal('fare_per_seat', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            // Correct unique key
            $table->unique(['company_id', 'departure_city', 'arrival_city', 'vehicle_type'], 'company_route_unique');


            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::disableForeignKeyConstraints();
    Schema::dropIfExists('routes');
    Schema::enableForeignKeyConstraints();
}

};
