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
        Schema::create('cargo_volume_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->decimal('min_volume', 10, 2); // in cm³
            $table->decimal('max_volume', 10, 2); // in cm³
            $table->decimal('rate_per_cm3', 10, 4); // precise rate
            $table->timestamps();
            
            $table->unique(['company_id', 'min_volume', 'max_volume']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_volume_tiers');
    }
};
