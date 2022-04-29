<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
	    if (!Schema::hasTable('ec_bookings')) {
		    Schema::create( 'ec_bookings', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->integer( 'order_id' );
			    $table->integer( 'product_id' );
			    $table->bigInteger( 'PickingUpDate' );
			    $table->bigInteger( 'DroppingOffDate' );
			    $table->integer( 'user_id' )->unsigned()->nullable();
			    $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
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
        Schema::dropIfExists('ec_booking');

    }
}
