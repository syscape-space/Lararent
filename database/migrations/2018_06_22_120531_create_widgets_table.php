<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('sidebar');
	        $table->integer('position');
	        $table->string('widget_id');
	        $table->string('callback');

	        $table->timestamps();
        });

	    Schema::create('widget_translations', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->integer('widget_id')->unsigned();

		    $table->string('name');
		    $table->text('output');



		    $table->string('locale')->index();
		    $table->unique(['widget_id','locale']);
		    $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
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
        Schema::dropIfExists('widgets');
    }
}
