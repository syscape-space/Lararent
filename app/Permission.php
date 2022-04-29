<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
	protected $fillable = ['name'];
    public function roles() {
		return $this->belongsToMany('Corp\Role','permission_role');

	}
}
