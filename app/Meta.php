<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    //
	use Translatable;

	public $translatedAttributes = ['translation_value'];
	protected $fillable = ['name','value','metable_id','metable_type'];


	public function metable()
	{
		return $this->morphTo();
	}

}
