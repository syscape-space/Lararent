<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration
{
	public function up()
	{
		Schema::create('portfolios', function (Blueprint $table) {
			$table->increments('id');

			$table->string('alias',255)->unique();
			$table->string('status',100);
			$table->string('img',255);

			$table->integer( 'user_id' )->unsigned()->default( 1 );
			$table->foreign('user_id')->references('id')->on('users');
			$table->softDeletes();
			$table->timestamps();
			$table->date( 'published_at' )->default( null );
		});


		Schema::create('portfolio_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('portfolio_id')->unsigned();

			$table->string('title',255);
			$table->text('text');
			$table->text('details');
			$table->string('keywords');
			$table->string('meta_desc');


			$table->string('locale')->index();
			$table->unique(['portfolio_id','locale']);
			$table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
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
		Schema::dropIfExists('portfolio_translations');
		Schema::dropIfExists('portfolios');

	}
}
