<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class PortfolioTranslation extends Model
{
    //
	protected $fillable = ['title','text','desc','keywords','meta_desc','details'];

	protected $guarded = ['id'];
}
