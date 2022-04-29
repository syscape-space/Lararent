<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PorCategory extends Model
{
	use Translatable;

	public $translatedAttributes = ['title','description'];
	protected $fillable = ['img','alias','parent_id','description','keywords'];

	//

	public function portfolio()
	{
		return $this->belongsToMany(Portfolio::class);
	}

	public function PorСategoryTranslation()
	{
		return $this->hasMany('Corp\PorCategoryTranslation');
	}

}
