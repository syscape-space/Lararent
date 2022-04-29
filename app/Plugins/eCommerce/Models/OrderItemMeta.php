<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemMeta  extends Model
{
	public $table = 'ec_order_item_meta';

	protected $fillable = [
		'key', 'title','value','order_id','order_id','product_id'];



	public function order_item() {
		return $this->belongsTo(OrderItemMeta::class);
	}

}
