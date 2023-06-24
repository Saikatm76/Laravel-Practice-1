<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num');
            $table->integer('user_id');
            $table->text('store_name');
            $table->integer('store_name_publication');
            $table->string('postal_code', 255);
            $table->text('title');
            $table->text('description');
            $table->string('list_image_filename1', 255);
            $table->string('list_image_filename2', 255)->nullable();
            $table->integer('term');
            $table->datetime('state0_at')->nullable();
            $table->integer('category_id');
            $table->integer('payment_order');
            $table->string('num_pop');
            $table->integer('money');
            $table->datetime('closed_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
