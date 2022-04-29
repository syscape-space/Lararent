<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    //
	protected $fillable = ['title','locale','category_id','description','keywords'];

	protected $guarded = ['id'];
}
