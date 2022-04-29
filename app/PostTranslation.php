<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    //

	protected $fillable = ['title','text','desc','keywords','meta_desc'];

	protected $guarded = ['id'];

}
