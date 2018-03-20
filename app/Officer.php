<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'officers';

    public static $rules = [
        'user_id' => 'required',
        'position_id' => 'required',
        'from' => 'required',
        'to' => 'required',
    ];
}
