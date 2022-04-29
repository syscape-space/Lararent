<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermTranslation extends Model
{
	public $table = 'ec_term_translations';

	protected $fillable = ['title','locale','category_id','description','keywords'];

	protected $guarded = ['id'];
}
