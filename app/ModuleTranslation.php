<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class ModuleTranslation extends Model
{
    	protected $fillable = ['translation_value','locale','value','variables','module_id'];

		protected $guarded = ['id'];
}
