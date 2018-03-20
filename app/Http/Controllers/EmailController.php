<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Cooperative;
use Auth;

class EmailController extends Controller
{
    public function userApproval(Request $request){

		$user = User::where('id', '=', $request->_userid)->first();
	  	$coop = Cooperative::whereNotNull('id')->first();
	  	$emailContent = "";


	  	if($request->_status == 'approve'){
	  		$emailContent = "email.approve_member";
	  	} else if ($request->_status == 'reject'){
	  		$emailContent = "email.reject_member";
	  	}

        Mail::send($emailContent, ['user' => $user, 'coop' => $coop], function ($message) use ($user)
        {
            $message->from('admin@mabuhay.com', 'Administrator');
            $message->to($user->email);
            $message->subject('Account Registration');
        });

        $user = User::findOrFail($request->_userid);

		$user->reviewed_by = Auth::user()->id;
		$user->reviewed_at = date('Y-m-d H:i:s');

	  	if($request->_status == 'approve'){
	  		$user->status = "waiting";
	  	} else if ($request->_status == 'reject'){
	  		$user->remarks = $request->remarks;
	  		$user->status = "rejected";
	  	}
		
        $user->update();
		

        return Redirect::route('admin.pending.index')->withFlashMessage('Email Sent!');
	}
}