<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class PorCategoryTranslation extends Model
{
    //
	protected $fillable = ['title','locale','category_id','description','keywords'];

	protected $guarded = ['id'];
}
