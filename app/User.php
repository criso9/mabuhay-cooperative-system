<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public static $reg_rules = [
        'f_name' => 'required',
        'emailadd' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'bday'=> 'required',
        'age'=>'required'
      // 'cnumber'=>'required'


    ];
}
