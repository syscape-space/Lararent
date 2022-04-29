<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('location')->unsigned()->default( 0 );;

	        $table->timestamps();
        });
	    Schema::create('menu_translations', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->integer('menu_id')->unsigned();

		    $table->string('title');
		    $table->text('output');



		    $table->string('locale')->index();
		    $table->unique(['menu_id','locale']);
		    $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
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
    	Schema::dropIfExists('menus_translations');
        Schema::dropIfExists('menus');

    }
}
