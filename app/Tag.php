<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
	//
	use Translatable;

	public $translatedAttributes = [ 'title', 'description', 'keywords' ];
	protected $fillable = [ 'img', 'alias', 'parent_id', 'description', 'keywords' ];

//	public function TagTranslation() {
//		return $this->hasMany( 'Corp\CategoryTranslation' );
//	}

	public function posts() {
		return $this->belongsToMany( Post::class ,'tag_post');
	}
}
