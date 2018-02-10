<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function index(){
        return View('register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request = Input::all(), User::$reg_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            $data = new User;

            $data->f_name = $request['f_name'];
            $data->m_name = $request['m_name'];
            $data->l_name = $request['l_name'];
            $data->phone = $request['phone'];
            $data->address = $request['address'];
            $data->b_date = $request['b_date'];
            $data->gender = $request['gender'];
            $data->email = $request['email'];
            $data->password = bcrypt($request['password']);
            $data->avatar = 'user-male.png';
            $data->status = 'active';
            $data->role_id = '3';
            $data->referral = $request['referral'];
            $data->ref_relation = $request['ref_relation'];
         
            $data->save();

           return redirect('/login');
    }
}


