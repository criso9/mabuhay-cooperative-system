<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    protected $table = 'cooperatives';
	public $timestamps = true;

	public static $rules = [
        'name' => 'required',
        'date_founded' => 'required',
        'mission' => 'required',
        'vision' => 'required',
    ];
}
