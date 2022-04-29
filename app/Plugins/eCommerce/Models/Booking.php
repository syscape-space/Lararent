<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking  extends Model {
	public $table = 'ec_bookings';
	protected $fillable = [
		'order_id',
		'product_id',
		'PickingUpDate',
		'DroppingOffDate',
		'user_id'
	];

	public function order() {
		return $this->belongsTo(Order::class, 'ec_bookings_order_id_foreign');
	}
	public function product(){
		return $this->belongsTo(Product::class);
	}

}