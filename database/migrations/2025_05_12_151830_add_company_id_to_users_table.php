<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add company_id column
            $table->foreignId('company_id')->nullable()->after('password');

            // Add foreign key constraint (after column is added)
            $table->foreign('company_id')
                  ->references('id')->on('companies')
                  ->onDelete('set null');

            // Add composite unique constraint
            $table->unique(['email', 'company_id']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email', 'company_id']);
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
}
