<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    if (!Schema::hasTable('ec_locations')) {
		    Schema::create( 'ec_locations', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->string( 'alias' );
			    $table->integer( 'user_id' )->unsigned()->default( 1 );
			    $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
			    $table->timestamps();


		    } );
	    }
	    if (!Schema::hasTable('ec_location_translations')) {
		    Schema::create( 'ec_location_translations', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->integer( 'location_id' )->unsigned();
			    $table->string( 'title' );
			    $table->string( 'locale' )->index();
			    $table->unique( [ 'location_id', 'locale' ] );
			    $table->foreign( 'location_id' )->references( 'id' )->on( 'ec_locations' )->onDelete( 'cascade' );
			    $table->timestamps();
		    } );
	    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ec_location');
        Schema::dropIfExists('ec_location_translations');
    }
}
