<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
	        $table->increments('id');

	        $table->string('alias',255)->unique();
	        $table->string('status',100);
	        $table->string('img',255);

	        $table->integer( 'user_id' )->unsigned()->default( 1 );
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');;


	        $table->softDeletes();
	        $table->timestamps();
	        $table->date( 'published_at' )->default( null );
        });


	    Schema::create('post_translations', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->integer('post_id')->unsigned();

		    $table->string('title',255);
		    $table->text('text');
		    $table->text('desc');
		    
		    $table->string('keywords');
		    $table->string('meta_desc');


		    $table->string('locale')->index();
		    $table->unique(['post_id','locale']);
		    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');;
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('post_translations');
        Schema::dropIfExists('posts');

    }
}
