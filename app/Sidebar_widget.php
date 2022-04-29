<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Sidebar_widget extends Model {
	//

	protected $fillable = [ 'widget_id', 'location' ];

	public function widget()
	{
		return $this->belongsTo('Corp\Widget');
	}
}

