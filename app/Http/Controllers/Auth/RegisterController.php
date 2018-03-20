<?php

namespace App\Http\Controllers\Auth;

use App\Cooperative;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index(){
        $coop = Cooperative::whereNotNull('id')->first();

        return View('auth.register', compact('coop'));
    }

    public function store(Request $request)
    {
        $dt = Carbon::parse($request['b_date']);
        $age = Carbon::createFromDate($dt->year, $dt->month, $dt->day)->age;
        $agree = $request['agree'];
        $gender = $request['gender'];
        $cStatus = $request['civil_status'];

        $validator = Validator::make($request = Input::all(), User::$reg_rules);

        //Add custom validation
        $validator->after(function ($validator) use ($agree, $age, $gender, $cStatus) {
            if($gender == 'Select Gender'){
                $validator->errors()->add('gender', 'The gender field is required.');
            }if($cStatus == 'Select Status'){
                $validator->errors()->add('civil_status', 'The civil status field is required.');
            }
            if($agree == 'no'){
                $validator->errors()->add('agree', 'You must agree with the terms and conditions');
            }
            if($age < 18){
                $validator->errors()->add('b_date', 'You must 18 or over to be a member in this Cooperative');
            }
        });

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
        $data->civil_status = $request['civil_status'];
        $data->email = $request['email'];
        $data->password = bcrypt($request['password']);

        if($request['gender'] == 'Male'){
            $data->avatar = 'user-male.png';
        }else if($request['gender'] == 'Female'){
            $data->avatar = 'user-female.png';
        }
        
        $data->status = 'pending';
        $data->role_id = '3';
        $data->referral = $request['referral'];
        $data->ref_relation = $request['ref_relation'];
     
        $data->save();

       return Redirect::route('login')->withFlashMessage('Please wait for the email regarding on the approval of your application. The process may take a while.');
    }

}


