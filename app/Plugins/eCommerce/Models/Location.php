<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{

	public $table = 'ec_locations';
	use Translatable;
	public $translatedAttributes = ['title'];

	protected $fillable = ['alias','user_id'];



}
