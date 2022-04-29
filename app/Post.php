<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
	use SoftDeletes;
	use Translatable;

	// trnalstions filds
	public $translatedAttributes = ['title', 'desc', 'text','keywords','meta_desc'];


//	protected $guarded = ['id'];
	//protected $guarded = ['id'];
	protected $fillable = ['img','alias','status','published_at'];


	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'published_at'


	];
	public function user() {
		return $this->belongsTo('Corp\User');
	}

//	public function category() {
//		return $this->belongsTo('Corp\Category');
//	}

	public function categories()
	{
		//return $this->hasMany(Category::class);
		return $this->belongsToMany('Corp\Category');
	}

	public function comments()
	{

		return $this->hasMany('Corp\Comment');
	}
	public function meta()
	{
		return $this->morphMany('Corp\Meta', 'metable');
	}
	public function tags(){
		return $this->belongsToMany('Corp\Tag','tag_post');
	}
//	public function translations()
//	{
//		return $this->belongsTo('Corp\PostTranslation');
//	}

}

//class PostTranslation extends Model
//{
//	public $timestamps = false;
//	protected $guarded = ['id'];
//
//}