<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_themes', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to companies table
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade'); // Optional: deletes theme if company is deleted

            // Theme fields
            $table->string('theme')->nullable();      // e.g. primary color
      

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_themes');
    }
};

