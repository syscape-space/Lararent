<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season  extends Model {
	public $table = 'ec_season';
	protected $fillable = [
		'base_price',
		'startDate',
		'endDate',
		'cost',
		'type',
		'product_id'
	];

	public function product() {
		return $this->belongsTo(Product::class);
	}

}