<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    if (!Schema::hasTable('ec_products')) {

		    Schema::create( 'ec_products', function ( Blueprint $table ) {
			    $table->increments( 'id' );

			    $table->string( 'alias', 255 )->unique();
			    $table->string( 'status', 100 );
			    $table->string( 'img', 255 );
			    $table->string( 'price', 255 );

			    $table->integer( 'user_id' )->unsigned()->default( 1 );
			    $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );

			    $table->date( 'published_at' )->default( null );
			    $table->softDeletes();
			    $table->timestamps();

		    } );
	    }
	    if (!Schema::hasTable('ec_product_translations')) {

		    Schema::create( 'ec_product_translations', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->integer( 'product_id' )->unsigned();

			    $table->string( 'title', 255 );
			    $table->text( 'text' );
			    $table->text( 'desc' );

			    $table->string( 'keywords' );
			    $table->string( 'meta_desc' );


			    $table->string( 'locale' )->index();
			    $table->unique( [ 'product_id', 'locale' ] );
			    $table->foreign( 'product_id' )->references( 'id' )->on( 'ec_products' )->onDelete( 'cascade' );
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
    	Schema::dropIfExists('ec_product_translations');
        Schema::dropIfExists('ec_products');

    }
}
