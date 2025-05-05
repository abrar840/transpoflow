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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('registration_number')->primary(); // Set as primary key

            // ✅ Define company_id before using it in a foreign key
            $table->unsignedBigInteger('company_id'); 
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->string('vehicle_type');
            $table->integer('seating_capacity');
            $table->string('make');
            $table->string('model'); // Changed from integer to string
            $table->integer('year');
            $table->boolean('is_active')->default(true);
            $table->boolean('scheduled')->default(false);
            $table->text('notes')->nullable();
            $table->integer('available_seats')->default(0); // or ->nullable()

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
