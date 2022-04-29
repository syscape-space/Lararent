<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    if (!Schema::hasTable('ec_orders')) {
		    Schema::create( 'ec_orders', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->string( 'gender' );
			    $table->string( 'name' );
			    $table->string( 'email' );
			    $table->string( 'phone' );
			    $table->string( 'street_address' );
			    $table->string( 'payment' );
			    $table->string( 'status' );
			    $table->decimal( 'total_price', 13, 2 );
			    $table->text( 'message' );
			    $table->string( 'ip' )->default( null );
			    $table->integer( 'user_id' )->unsigned()->nullable();
			    $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );

			    $table->timestamps();
		    } );
	    }
	    if (!Schema::hasTable('ec_order_items')) {
		    Schema::create( 'ec_order_items', function ( Blueprint $table ) {
			    $table->increments( 'id' );


			    $table->integer( 'quantity' );
			    $table->decimal( 'price', 12, 2 );
			    $table->string( 'sku' )->default( null );

			    $table->integer( 'order_id' )->unsigned()->default( null );
			    $table->foreign( 'order_id' )->references( 'id' )->on( 'ec_orders' )->onDelete( 'cascade' );

			    $table->integer( 'product_id' )->unsigned()->default( null );
			    $table->foreign( 'product_id' )->references( 'id' )->on( 'ec_products' );

			    $table->timestamps();
		    } );

	    }
	    if (!Schema::hasTable('ec_order_item_meta')) {
		    Schema::create( 'ec_order_item_meta', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->string( 'key' );
			    $table->string( 'title' );
			    $table->text( 'value' );


			    $table->integer( 'order_item_id' )->unsigned()->default( null );
			    $table->foreign( 'order_item_id' )->references( 'id' )->on( 'ec_order_items' )->onDelete( 'cascade' );

			    $table->integer( 'product_id' )->unsigned()->default( null );
			    $table->foreign( 'product_id' )->references( 'id' )->on( 'ec_products' );

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
        Schema::dropIfExists('order');
        Schema::dropIfExists('ec_order_item_meta');
        Schema::dropIfExists('ec_order_items');
    }
}
