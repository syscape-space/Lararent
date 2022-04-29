<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (!Schema::hasTable('ec_orders')) {
			Schema::table( 'ec_orders', function ( Blueprint $table ) {
				//
				$table->integer( 'coupon_id' )->nullable();
				$table->decimal( 'discount', 13, 2 )->nullable();
			} );
		}
		if (!Schema::hasTable('coupons')) {
			Schema::create( 'coupons', function ( Blueprint $table ) {
				$table->increments( 'id' );
				$table->string( 'code' )->unique();
				$table->string( 'type' );
				$table->float( 'value' )->nullable();
				$table->string( 'meta' )->nullable();
				$table->integer( 'user_id' )->unsigned()->default( 1 );
				$table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
				$table->timestamps();

			} );
		}


	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'coupons' );
	}
}
