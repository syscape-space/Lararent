<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'tags', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'alias' )->unique();
			$table->timestamps();

		} );

		Schema::create( 'tag_translations', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'tag_id' )->unsigned();
			$table->string( 'title' );
			$table->text( 'keywords' )->default( null );
			$table->text( 'description' )->default( null );
			$table->string( 'locale' )->index();
			$table->unique( [ 'tag_id', 'locale' ] );
			$table->foreign( 'tag_id' )->references( 'id' )->on( 'tags' )->onDelete( 'cascade' );
			$table->timestamps();
		} );
		Schema::create( 'tag_post', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'tag_id' )->unsigned();
			$table->integer( 'post_id' )->unsigned();
			$table->foreign( 'tag_id' )->references( 'id' )->on( 'tags' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
			$table->foreign( 'post_id' )->references( 'id' )->on( 'posts' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'tags' );
		Schema::dropIfExists( 'tag_translations' );
		Schema::dropIfExists( 'tag_post' );
	}
}
