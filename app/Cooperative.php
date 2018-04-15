<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    protected $table = 'cooperatives';
	public $timestamps = true;

	public static $rules = [
        'coop_name' => 'required',
        'date_founded' => 'required',
        'mission' => 'required',
        'vision' => 'required',
        'logo' => 'image|mimes:jpg,png',
        'icon' => 'mimes:ico',
        'mem_int' => 'required',
        'nonmem_int' => 'required',
        'docs' => 'mimes:pdf,doc,docx,',
    ];

    public static $carousel_rules = [
    	'url' => 'required',
    ];

    public static $docs_rules = [
    ];
}
