<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
	use Translatable;

	protected $fillable = ['location'];
	// trnalstions filds

	public $translatedAttributes = ['title', 'output'];

	public function locations()
	{
		return $this->hasMany('Corp\Locations_menu');
	}

}
