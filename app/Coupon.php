<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code','type','value','meta','percent_off'];



}
