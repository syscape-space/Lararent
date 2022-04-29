<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    //
	protected $fillable = ['translation_value','locale','meta_id'];

	protected $guarded = ['id'];
}
