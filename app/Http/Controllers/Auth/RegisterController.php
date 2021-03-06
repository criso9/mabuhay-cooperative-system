<?php

namespace App\Http\Controllers\Auth;

use App\Cooperative;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DateTime;

class RegisterController extends BaseController
{
    public function index(){
        $gender = ['Select Gender', 'Male', 'Female'];
        $civilstat = ['Select Status', 'Single', 'Married', 'Separated', 'Widowed'];
        $refRelation = ['Select Relationship', 'Family', 'Friends', 'Classmate/Batchmate', 'Co-worker', 'Friends of Friends'];

        return View('auth.register', compact('gender', 'civilstat', 'refRelation'));
    }

    public function store(Request $request)
    {
        $dt = Carbon::parse($request['b_date']);
        $age = Carbon::createFromDate($dt->year, $dt->month, $dt->day)->age;
        $agree = $request['agree'];
        $gender = $request['gender'];
        $cStatus = $request['civil_status'];
        $referral = $request['referral'];
        $refRel = $request['ref_relation'];

        $validator = Validator::make($request = Input::all(), User::$reg_rules);

        $email = User::select('id')->where('email', '=', $request['email'])->count();
        $fullName = User::select('id')
        ->where('f_name', '=', $request['f_name'])
        ->where('l_name', '=', $request['l_name'])
        ->where('m_name', '=', $request['m_name'])
        ->count();

       
        //Add custom validation
        $validator->after(function ($validator) use ($agree, $age, $gender, $cStatus, $email, $referral, $refRel, $fullName) {
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
            if($email > 0){
                $validator->errors()->add('email', 'Email is already registered.');
            }
            if($fullName > 0){
                $validator->errors()->add('f_name', 'Name is already registered (Last, First and Middle Name).');
            }
            if($referral != '' || $referral != null){
                if($refRel == 'Select Relationship'){
                    $validator->errors()->add('ref_relation', 'The Referral Relationship field is required.');
                }
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

        $bDate = DateTime::createFromFormat('M d, Y', $request['b_date']);
        $data->b_date = $bDate->format('Y-m-d');

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
        $data->ref_relation = $refRel;
     
        $data->save();

       return Redirect::route('login')->withFlashMessage('Please wait for the email regarding on the approval of your application. The process may take a while.');
    }

}


