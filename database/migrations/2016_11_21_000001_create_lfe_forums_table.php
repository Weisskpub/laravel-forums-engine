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
        Schema::create('lfe_forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->default(0);
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->boolean('is_category')->default(FALSE);
            $table->boolean('is_active')->default(TRUE)->index();
            $table->smallInteger('rank')->default(0)->index();

            $table->bigInteger('user_id')->index()->nullable(); // last post info cache
            $table->bigInteger('topic_id')->index()->nullable(); // last post info cache
            $table->bigInteger('post_id')->index()->nullable(); // last post info cache

            $table->index(['parent_id','id']);
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
