<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLfeFaggrsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lfe_faggrs', function (Blueprint $table) {
			$table->increments('id');
			$table->smallInteger('rank')->default(0)->index();
			$table->string('title')->index();
			$table->boolean('is_active')->default(TRUE)->index();
			$table->timestamps();
			$table->index( 'created_at' );
			$table->index( 'updated_at' );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lfe_faggrs');
	}
}
