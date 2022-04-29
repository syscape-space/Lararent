<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name');
	        $table->text('value');
            $table->timestamps();

        });

	    Schema::create( 'option_translations', function ( Blueprint $table ) {
		    $table->increments( 'id' );
		    $table->integer( 'option_id' )->unsigned();
		    $table->text('translation_value');


		    $table->string( 'locale' )->index();
		    $table->unique( [ 'option_id', 'locale' ] );
		    $table->foreign( 'option_id' )->references( 'id' )->on( 'options' )->onDelete( 'cascade' );
		    $table->timestamps();
	    } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option');
    }
}
