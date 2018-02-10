<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    protected $table = 'cooperatives';
	public $timestamps = true;

	public static $rules = [
        'name' => 'required',
        'logo' => 'required',
        'banner' => 'required',
    ];
}
