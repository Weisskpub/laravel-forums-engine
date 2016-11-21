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
        Schema::create('lfe_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('topic_id');
            $table->bigInteger('forum_id')->index();
            $table->bigInteger('user_id')->index();
            $table->boolean('is_active')->default(TRUE)->index();
            $table->text('body');
            $table->timestamps();
            $table->index(['topic_id','id']);
            $table->index('updated_at');
            $table->index('created_at');
            
            $table->foreign('forum_id')->references('id')->on( 'lfe_forums' )->onDelete('cascade');
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
