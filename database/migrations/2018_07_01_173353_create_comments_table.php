<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
	        $table->increments('id');
	        $table->text('text');
	        $table->string('name');
	        $table->string('email');
	        $table->string('site');

	        $table->integer('parent_id');

	        $table->integer('post_id')->unsigned()->default(1);
	        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');

	        $table->string( 'status',100 );
	        $table->string( 'locale',100 );

	        $table->integer('user_id')->unsigned()->nullable();
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');;
	        $table->softDeletes();

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
        Schema::dropIfExists('comments');
    }
}
