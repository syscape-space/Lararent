<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	//
	protected $fillable = ['name','text','site','user_id','article_id','parent_id','email','status','locale'];


//	public function article() {
//		return $this->belongsTo('Corp\Post');
//	}

	public function post() {
		return $this->belongsTo('Corp\Post');
	}

	public function user() {
		return $this->belongsTo('Corp\User');
	}
}
