<?php

namespace Corp;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {

	//
	use SoftDeletes;
	use Translatable;

	// transitions fields
	public $translatedAttributes = [ 'title', 'text', 'keywords', 'meta_desc' ];
	protected $fillable = [ 'img', 'alias', 'status', 'published_at' ];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'published_at'


	];

	public function user() {
		return $this->belongsTo( 'Corp\User' );
	}

	public function meta() {
		return $this->morphMany( 'Corp\Meta', 'metable' );
	}

	public function module() {
		return $this->morphMany( 'Corp\Module', 'metable' );
	}




}
