<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdToEverything extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calls', function(Blueprint $table)
		{
			$table->integer('company_id');
		});
		
		Schema::table('groups', function(Blueprint $table)
		{
			$table->integer('company_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calls', function(Blueprint $table)
		{
			$table->dropColumn('company_id');
		});
		Schema::table('groups', function(Blueprint $table)
		{
			$table->dropColumn('company_id');
		});
    }
}
