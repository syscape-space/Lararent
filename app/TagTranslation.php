<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    //
	protected $fillable = ['title','locale','description','keywords'];

	protected $guarded = ['id'];
}
