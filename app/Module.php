<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
	use Translatable;

	public $translatedAttributes = ['value','variables'	];
	protected $fillable = ['name','metable_id','metable_type','sorting'];


	public function metable()
	{
		return $this->morphTo();
	}

}
