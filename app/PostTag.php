<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    //
	protected $table = 'tag_post';

	protected $fillable = ['tag_id','post_id'];

	public function tags(){
		return $this->belongsToMany(Tag::class,'tags');
	}
	public function posts(){
		return $this->belongsToMany(Post::class,'posts');
	}
}
