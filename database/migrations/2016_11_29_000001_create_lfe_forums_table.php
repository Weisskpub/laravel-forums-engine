<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLfeForumsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lfe_forums', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';
//			$table->increments('id'); // use in postgresql
			$table->integer('id',true); // use in mysql as increments to support foreign keys
			$table->integer('f_aggr_id')->index();
			$table->integer('parent_id')->default(0)->index();
			$table->smallInteger('rank')->default(0)->index();
			$table->boolean('is_active')->default(TRUE)->index();
			$table->boolean('is_category')->default(FALSE);
			$table->string('title')->index();
			$table->text('description')->nullable();
			$table->bigInteger('last_post')->nullable();
			$table->timestamps();
			$table->index( 'created_at' );
			$table->index( 'updated_at' );
			$table->foreign('f_aggr_id')->references('id')->on('lfe_faggrs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lfe_forums');
	}
}
