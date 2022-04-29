<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
    //
	protected $fillable = ['path','directory','filename','mime_type','aggregate_type','size'];
	public function posts()
	{
		return $this->hasMany(Post::class);
	}

}
