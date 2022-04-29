<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem  extends Model
{
	public $table = 'ec_order_items';

	protected $fillable = [
		'quantity','price','sku','order_id','product_id'];




	public function order() {
		return $this->belongsTo(Order::class);
	}

	public function meta(){
		return $this->hasMany(OrderItemMeta::class);
	}

	public function product(){
		return $this->belongsTo(Product::class);
	}
}
