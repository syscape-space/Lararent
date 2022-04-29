<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Locations_menu extends Model
{
	protected $fillable = ['menu_id','locations'];
    //
	public function menu()
	{
		return $this->belongsTo('Corp\Menu');
	}
}
