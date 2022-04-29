<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations_menus', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('locations');
	        $table->integer('menu_id')->unsigned();
	        $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');;
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
        Schema::dropIfExists('menus_locations');
    }
}
