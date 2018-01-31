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
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function checkRoles()
    {
        if($this->role_id == 1)
        { 
            return "admin"; 
        }
        else if($this->role_id == 2)
        {
            return "officer";
        }
        else if($this->role_id == 3)
        {
            return "member";
        }
        else 
        { 
            return false; 
        }
    }
}
