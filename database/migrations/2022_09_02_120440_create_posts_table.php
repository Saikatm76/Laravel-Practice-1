<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // $table->id();
            // $table->bigIncrements('id');
            $table->increments('id');
            $table->integer('user_id')->unsigned();  ///for relationship eloquent orm
            // $table->increments('id')->unsigned();
            // $table->string('title',255)->nullable;  #`title` varchar(255) DEFAULT NULL
            $table->string('title')->default('no title')->comment('this is title');
            $table->text('body');
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
        Schema::dropIfExists('posts');
    }
}
