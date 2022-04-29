<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (!Schema::hasTable('ec_products')) {
			Schema::create( 'ec_terms', function ( Blueprint $table ) {
				$table->increments( 'id' );

				$table->integer( 'parent_id' )->default( 0 );
				$table->string( 'alias' )->unique();
				$table->string( 'type' );
				$table->integer( 'img' )->default( 0 );
				$table->timestamps();
			} );

		}
		// translations  table
		if ( !Schema::hasTable( 'ec_term_translations' ) ) {
			Schema::create( 'ec_term_translations', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'term_id' )->unsigned();

				$table->string( 'title' );
				$table->text( 'keywords' );
				$table->text( 'description' );


				$table->string( 'locale' )->index();
				$table->unique( [ 'term_id', 'locale' ] );
				$table->foreign( 'term_id' )->references( 'id' )->on( 'ec_terms' )->onDelete( 'cascade' );
				$table->timestamps();
			} );
		}

		if (!Schema::hasTable('ec_orders')) {
			Schema::create( 'ec_terms_product', function ( Blueprint $table ) {
				$table->integer( 'term_id' )->unsigned();
				$table->integer( 'product_id' )->unsigned();
				$table->foreign( 'term_id' )->references( 'id' )->on( 'ec_terms' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
				$table->foreign( 'product_id' )->references( 'id' )->on( 'ec_products' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
			} );
		}

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'ec_categories' );
	}
}
