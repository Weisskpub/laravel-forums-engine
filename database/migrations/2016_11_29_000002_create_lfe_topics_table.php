<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLfeTopicsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lfe_topics', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('forum_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->boolean('is_active')->index();
			$table->string('title')->index();
			$table->integer('last_post')->nullable();
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
		Schema::dropIfExists('lfe_topics');
	}
}
