<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationTranslation extends Model
{
	public $table = 'ec_location_translations';

	protected $fillable = ['title','locale','location_id'];

	protected $guarded = ['id'];
}
