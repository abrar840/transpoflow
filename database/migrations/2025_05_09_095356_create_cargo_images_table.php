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
        // database/migrations/xxxx_create_cargo_images_table.php
Schema::create('cargo_images', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cargo_book_id')->constrained()->onDelete('cascade');
    $table->string('image_path');
    $table->string('caption')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_images');
    }
};
