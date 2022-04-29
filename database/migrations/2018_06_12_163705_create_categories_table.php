<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if ( !Schema::hasTable( 'categories' ) ) {
			Schema::create( 'categories', function ( Blueprint $table ) {
				$table->increments( 'id' );


				$table->integer( 'parent_id' )->default( 0 );
				$table->string( 'alias' )->unique();
				$table->integer( 'img' )->default( 0 );
				$table->timestamps();


			} );
		}


		if ( !Schema::hasTable( 'category_translations' ) ) {
			Schema::create( 'category_translations', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->integer( 'category_id' )->unsigned();

				$table->string( 'title' );
				$table->text( 'keywords' );
				$table->text( 'description' );


				$table->string( 'locale' )->index();
				$table->unique( [ 'category_id', 'locale' ] );
				$table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onDelete( 'cascade' );
				$table->timestamps();
			} );
		}

		if ( !Schema::hasTable( 'category_translations' ) ) {
			Schema::create( 'category_post', function ( Blueprint $table ) {
				$table->integer( 'category_id' )->unsigned();
				$table->integer( 'post_id' )->unsigned();
				$table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
				$table->foreign( 'post_id' )->references( 'id' )->on( 'posts' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
			} );
		}


	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public
	function down() {


		Schema::dropIfExists( 'categories_translations' );
		Schema::dropIfExists( 'categories' );


	}
}
