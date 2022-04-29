<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	use Translatable;

	public $translatedAttributes = ['title','description'];
	protected $fillable = ['img','alias','parent_id','description','keywords'];

	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}

	public function CategoryTranslation()
	{
		return $this->hasMany('Corp\CategoryTranslation');
	}
}
