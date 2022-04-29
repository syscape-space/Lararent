<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediableTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path', 255);
            $table->string('directory');
            $table->string('filename');
            $table->string('mime_type', 128);
            $table->string('aggregate_type', 32);
            $table->integer('size')->unsigned();
            $table->text('image_sizes');
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

        Schema::drop('medias');
    }
}
