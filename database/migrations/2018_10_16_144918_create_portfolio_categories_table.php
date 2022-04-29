<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    if ( !Schema::hasTable( 'por_categories' ) ) {
		    Schema::create( 'por_categories', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->integer( 'parent_id' )->default( 0 );
			    $table->string( 'alias' )->unique();
			    $table->integer( 'img' )->default( 0 );
			    $table->timestamps();
		    } );
	    }
	    if ( !Schema::hasTable( 'por_category_translations' ) ) {
		    Schema::create( 'por_category_translations', function ( Blueprint $table ) {
			    $table->increments( 'id' );
			    $table->integer( 'por_category_id' )->unsigned();

			    $table->string( 'title' );
			    $table->text( 'keywords' );
			    $table->text( 'description' );


			    $table->string( 'locale' )->index();
			    $table->unique( [ 'por_category_id', 'locale' ] );
			    $table->foreign( 'por_category_id' )->references( 'id' )->on( 'por_categories' )->onDelete( 'cascade' );
			    $table->timestamps();
		    } );
	    }
	    if ( !Schema::hasTable( 'por_category_portfolio' ) ) {
		    Schema::create( 'por_category_portfolio', function ( Blueprint $table ) {
			    $table->integer( 'por_category_id' )->unsigned();
			    $table->integer( 'portfolio_id' )->unsigned();
			    $table->foreign( 'por_category_id' )->references( 'id' )->on( 'por_categories' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
			    $table->foreign( 'portfolio_id' )->references( 'id' )->on( 'portfolios' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
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
    	Schema::dropIfExists('por_category_translations');
    	Schema::dropIfExists('por_category_portfolio');
        Schema::dropIfExists('por_categories');

    }
}
