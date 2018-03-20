<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    public static $rules = [
        'user_id' => 'required',
        'from' => 'required',
        'to' => 'required',
    ];
}
