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

    protected $dates = ['reviewed_at', 'activated_at', 'created_at', 'updated_at'];

	public static $reg_rules = [
        'f_name' => 'required',
        'l_name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'b_date'=> 'required',
        'gender'=> 'required',
        'civil_status'=> 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public static $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function monthly_contribution()
    {
        return $this->hasOne('App\MonthlyContribution');
    }

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
