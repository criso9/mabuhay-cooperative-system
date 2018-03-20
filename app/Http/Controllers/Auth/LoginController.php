<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Cooperative;

class LoginController extends Controller
{

    public function getLogin(){
        $coop = Cooperative::whereNotNull('id')->first();
        return View('auth.login', compact('coop'));
    }

    public function postLogin(){
        $data = Input::all();

        $validator = Validator::make($data, User::$rules);

        //dd($data);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
            if (Auth::user()->status == 'active') {
                if (Auth::user()->role_id == '1') {
                    return Redirect::intended('/admin');
                } else if (Auth::user()->role_id == '2') {
                    return Redirect::intended('/officer');
                } else if (Auth::user()->role_id == '3') {
                    return Redirect::intended('/member');
                }
            } else {
                return Redirect::back()->withErrors('This account is not active.')->withInput();
            }
            // $_SESSION["user_id"] = Auth::user()->id;
            // $_SESSION["email"] = Auth::user()->email;
            // $_SESSION['loggedin_time'] = time(); 

        } else {
            return Redirect::back()->withErrors('These credentials do not match our records.')->withInput();
        }

        // if(isset($_SESSION["user_id"])) {
        //     if(!isLoginSessionExpired()) {
        //         if (Auth::user()->role_id == '1') {
        //             return Redirect::intended('/admin');
        //         } else if (Auth::user()->role_id == '2') {
        //             return Redirect::intended('/officer');
        //         } else if (Auth::user()->role_id == '3') {
        //             return Redirect::intended('/member');
        //         }
        //     } else {
        //         header("Location:/logout?session_expired=1");
        //     }
        // }
        
        //return Redirect::to('/admin');
    }

    // public function isLoginSessionExpired() {
    //     $login_session_duration = 10; 
    //     $current_time = time(); 
    //     if(isset($_SESSION['loggedin_time']) and isset($_SESSION["user_id"])){  
    //         if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
    //             return true; 
    //         } 
    //     }
    //     return false;
    // }

    public function getLogout(){
        Auth::logout();

        // session_start();
        // unset($_SESSION["user_id"]);
        // unset($_SESSION["email"]);
        // $url = "/login";
        // if(isset($_GET["session_expired"])) {
        //     $url .= "?session_expired=" . $_GET["session_expired"];
        // }
        //header("Location:$url");

        return Redirect::route('login');
    }
}
