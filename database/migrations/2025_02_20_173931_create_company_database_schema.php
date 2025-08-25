<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDatabaseSchema extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['fleet', 'shuttle', 'transport']);
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('logo')->nullable();
            $table->string('admin_username');
            $table->enum('num_employees', ['<5', '5-20', '20-100', '100-250', '>250']);
            $table->timestamps();
        });
        

        // Websites Table
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('domain_name')->unique();
            $table->bigInteger('template_id');
            $table->timestamps();
        });

        // Services Table
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Company Services (Pivot Table)
        Schema::create('company_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->timestamps();
        });

        // Color Palettes Table
        Schema::create('color_palettes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color_1', 7);
            $table->string('color_2', 7);
            $table->string('color_3', 7);
            $table->timestamps();
        });

        // Company Colors (Pivot Table)
        Schema::create('company_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('color_palette_id')->constrained('color_palettes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_colors');
        Schema::dropIfExists('color_palettes');
        Schema::dropIfExists('company_services');
        Schema::dropIfExists('services');
        Schema::dropIfExists('websites');
        Schema::dropIfExists('companies');
    }
}
