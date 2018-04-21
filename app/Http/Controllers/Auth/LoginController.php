<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use DB;
use App\Cooperative;

class LoginController extends BaseController
{

    public function getLogin(){
        return View('auth.login');
    }

    public function postLogin(){
        $data = Input::all();

        $validator = Validator::make($data, User::$rules);

        //dd($data);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'), 'status' => 'active'))){
            // if (Auth::user()->status == 'active') {
           
            $loans = DB::table('loans')
            ->select('loans.transaction_no', 'loans.due_date')
            ->where('loans.user_id', '=', Auth::user()->id)
            ->where('loans.status', 'active')
            ->get();

            $msg = 'Please be reminded that you have existing loan/s. You can check the Loans page for more details.';

            // if($loans->count() > 1){
            //     foreach ($loans as $l) {
            //         // dd($l->transaction_no);
            //     }
            // }else if($loans->count() > 0){
            //     // dd($loans[0]->transaction_no);
            // }

            if($loans->count() > 0){
                if (Auth::user()->role_id == '1') {
                    return Redirect::intended('/admin')->withFlashMessage($msg);
                } else if (Auth::user()->role_id == '2') {
                    return Redirect::intended('/officer')->withFlashMessage($msg);
                } else if (Auth::user()->role_id == '3') {
                    return Redirect::intended('/member')->withFlashMessage($msg);
                }
            }else{
                if (Auth::user()->role_id == '1') {
                    return Redirect::intended('/admin');
                } else if (Auth::user()->role_id == '2') {
                    return Redirect::intended('/officer');
                } else if (Auth::user()->role_id == '3') {
                    return Redirect::intended('/member');
                }
            }
        } else {
            return Redirect::back()->withErrors('These credentials do not match our records or the account is not active')->withInput();
        }
    }

    public function getLogout(){
        Auth::logout();

        return Redirect::route('login');
    }
}
