<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Cooperative;
use App\Loan;
use Auth;
use Tzsk\Sms\Facade\Sms;

class EmailController extends BaseController
{
    public function userApproval(Request $request){

		$user = User::where('id', '=', $request->_userid)->first();
	  	$emailContent = "";


	  	if($request->_status == 'approve'){
	  		$emailContent = "email.approve_member";
	  	} else if ($request->_status == 'reject'){
	  		$emailContent = "email.reject_member";
	  	}

        Mail::send($emailContent, ['user' => $user, 'coop' => $this->coop], function ($message) use ($user)
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

	public function loanApproval(Request $request){
		$loan = Loan::where('id', '=', $request->_id)->first();
		$user = User::where('id', '=', $loan->user_id)->first();
		
	  	$emailContent = "";

	  	if($request->_status == 'approve'){
	  		$emailContent = "email.approve_loan";
	  	} else if ($request->_status == 'reject'){
	  		$emailContent = "email.reject_loan";
	  	}

        Mail::send($emailContent, ['user' => $user, 'loan' => $loan, 'coop' => $this->coop], function ($message) use ($user)
        {
            $message->from('admin@mabuhay.com', 'Administrator');
            $message->to($user->email);
            $message->subject('Loan Application');
        });

        Sms::send("Text to send.", function($sms) {
		    $sms->to(['+639151178289']); # The numbers to send to.
		});

        $loanUpdate = Loan::findOrFail($request->_id);
    	$msg = "";

		if($request->_status == "approve"){
			$loanUpdate->status = "Approve";
			$loanUpdate->remaining_balance = $request->_remBal;
		} else if($request->_status == "reject"){
			$loanUpdate->status = "Rejected";
			$loanUpdate->remarks = $request->remarks;
		} else {
			return Redirect::route('admin.admin.index')->withFlashMessage('No changes was made');
		}

		$loanUpdate->reviewed_by = Auth::user()->id;
		$loanUpdate->reviewed_at = date('Y-m-d H:i:s');
		
        $loanUpdate->update();

        if($request->_status == "approve"){
			$msg = "Loan application was approve";
		} else if($request->_status == "reject"){
			$msg = "Loan application was rejected";
		}

		return Redirect::route('officer.loan.index')->withFlashMessage($msg);
	}
}