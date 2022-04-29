<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
	use Translatable;

	protected $fillable = ['sidebar','widget_id','position','callback'];
	// trnalstions filds
	public $translatedAttributes = ['output', 'name'];

    //
	public function sidebar()
	{
		return $this->hasMany('Corp\Sidebar_widget');
	}
}
