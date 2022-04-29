<?php

namespace Corp\Plugins\eCommerce\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
	public $table = 'ec_terms';

	use Translatable;
	public $translatedAttributes = ['title', 'desc', 'text','keywords','meta_desc'];

	protected $fillable = ['img', 'type', 'alias','status','published_at','price'];

	public function products() {
		return $this->belongsToMany(Product::class,'ec_terms_product');
	}

	public function CategoryTranslation()
	{
		return $this->hasMany();
	}

}
