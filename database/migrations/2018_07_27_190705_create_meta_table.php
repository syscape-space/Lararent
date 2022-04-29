<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
	        $table->text('value');
            $table->integer('metable_id');
            $table->string('metable_type');
            $table->timestamps();
        });


	    Schema::create( 'meta_translations', function ( Blueprint $table ) {
		    $table->increments( 'id' );
		    $table->integer( 'meta_id' )->unsigned();
		    $table->text('translation_value');


		    $table->string( 'locale' )->index();
		    $table->unique( [ 'meta_id', 'locale' ] );
		    $table->foreign( 'meta_id' )->references( 'id' )->on( 'metas' )->onDelete( 'cascade' );
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

        Schema::dropIfExists('meta_translations');
        Schema::dropIfExists('meta');
    }
}
