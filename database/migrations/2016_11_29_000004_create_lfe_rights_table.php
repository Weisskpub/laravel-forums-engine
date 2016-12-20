<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLfeRightsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lfe_rights', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';
//			$table->increments('id'); // use in postgresql
			$table->integer('id',true); // use in mysql as increments to support foreign keys
			$table->integer('user_id')->index();
			$table->integer('forum_id')->nullable()->index();
			$table->boolean('is_admin')->default(FALSE)->index();
			$table->boolean('is_moderator')->default(FALSE)->index();
			$table->timestamps();
			$table->index('updated_at');
			$table->index('created_at');
			$table->foreign('forum_id')->references('id')->on( 'lfe_forums' )->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on( 'users' )->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lfe_rights');
	}
}
