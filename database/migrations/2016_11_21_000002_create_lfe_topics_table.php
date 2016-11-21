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
        Schema::create('lfe_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('forum_id')->index();
            $table->bigInteger('user_id')->index();
            $table->boolean('is_active')->index();
            $table->integer('views')->default(0);
            $table->string('title')->index();
            
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
