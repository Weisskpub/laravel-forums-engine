<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLfePostsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lfe_posts', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';
//			$table->increments('id'); // use in postgresql
			$table->integer('id',true); // use in mysql as increments to support foreign keys
			$table->integer('forum_id')->index();
			$table->integer('topic_id')->index();
			$table->integer('user_id')->index();
			$table->boolean('is_active')->default(TRUE)->index();
			$table->ipAddress('ip')->index();
			$table->text('message');
			$table->timestamps();
			$table->index('updated_at');
			$table->index('created_at');
			$table->foreign('topic_id')->references('id')->on( 'lfe_topics' )->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lfe_posts');
	}
}
