<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colors', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('user_id');
			$table->char('color_dark_primary',   6)->default('0288D1');
			$table->char('color_primary',        6)->default('03A9F4');
			$table->char('color_light_primary',  6)->default('B3E5FC');
			$table->char('color_icons',          6)->default('FFFFFF');
			$table->char('color_accent',         6)->default('FF5722');
			$table->char('color_text_primary',   6)->default('212121');
			$table->char('color_text_secondary', 6)->default('727272');
			$table->char('color_divider',        6)->default('B6B6B6');
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('colors');
	}

}
