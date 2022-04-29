<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('modules', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('name');
	        $table->integer('metable_id');
	        $table->string('metable_type');
	        $table->integer('sorting');
	        $table->timestamps();
        });

	    Schema::create( 'module_translations', function ( Blueprint $table ) {
		    $table->increments( 'id' );
		    $table->integer( 'module_id' )->unsigned();
		    $table->text('value');
		    $table->text('variables');
		    $table->string( 'locale' )->index();
		    $table->unique( [ 'module_id', 'locale' ] );
		    $table->foreign( 'module_id' )->references( 'id' )->on( 'modules' )->onDelete( 'cascade' );
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
    	Schema::dropIfExists('module_translations');
        Schema::dropIfExists('modules');

    }
}
