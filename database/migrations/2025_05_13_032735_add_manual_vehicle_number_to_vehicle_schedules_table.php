<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('vehicle_schedules', function (Blueprint $table) {
        $table->string('manual_vehicle_number')->nullable()->after('vehicle_id');
    });
}


    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('vehicle_schedules', function (Blueprint $table) {
        $table->dropColumn('manual_vehicle_number');
    });
}

};
