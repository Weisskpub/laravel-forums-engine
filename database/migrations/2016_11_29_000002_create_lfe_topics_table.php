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
//			$table->increments('id'); // use in postgresql
			$table->integer('id',true); // use in mysql as increments to support foreign keys
			$table->integer('forum_id')->index();
			$table->integer('user_id')->index();
			$table->boolean('is_active')->index();
			$table->string('title')->index();
			$table->bigInteger('last_post')->nullable();
			$table->timestamps();
			$table->index( 'created_at' );
			$table->index( 'updated_at' );
			$table->foreign('forum_id')->references('id')->on( 'lfe_forums' )->onDelete('cascade');
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
