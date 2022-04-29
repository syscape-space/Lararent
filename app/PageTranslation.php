<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    //
	protected $fillable = ['title','text','keywords','meta_desc'];

	protected $guarded = ['id'];

}
