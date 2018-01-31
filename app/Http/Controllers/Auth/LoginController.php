<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;

class LoginController extends Controller
{

    public function getLogin(){
        return View('auth.login');
    }

    public function postLogin(){
        $data = Input::all();

        $validator = Validator::make($data, User::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
            return Redirect::intended('/');
        } else {
            return Redirect::back()->withErrors('These credentials do not match our records.')->withInput();
        }
        
        return Redirect::route('login');
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::route('login');
    }
}
