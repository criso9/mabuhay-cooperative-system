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
use App\Announcement;
use App\MonthlyContribution;
use Carbon\Carbon;
use DateTime;
use Auth;

class EmailController extends BaseController
{
    public function userApproval(Request $request){

		$user = User::where('id', '=', $request->_userid)->first();
	  	$emailContent = "";
	  	$remarks = $request->remarks;


	  	if($request->_status == 'approve'){
	  		$emailContent = "email.approve_member";
	  	} else if ($request->_status == 'reject'){
	  		$emailContent = "email.reject_member";
	  	}

	  	$coopname = $this->coop->coop_name;

        Mail::send($emailContent, ['user' => $user, 'coop' => $this->coop, 'remarks' => $remarks], function ($message) use ($user, $coopname)
        {
            $message->from('administrator@mabuhaybnhs.com', $coopname);
            $message->to($user->email);
            $message->subject('Account Registration');
        });

        $user = User::findOrFail($request->_userid);

		$user->reviewed_by = Auth::user()->id;
		$user->reviewed_at = date('Y-m-d H:i:s');

	  	if($request->_status == 'approve'){
	  		$user->status = "waiting";
	  	} else if ($request->_status == 'reject'){
	  		$user->remarks_reviewed = $request->remarks;
	  		$user->status = "rejected";
	  	}
		
        $user->update();
		

        return Redirect::route('admin.pending.index')->withFlashMessage('Email Sent!');
	}

	public function loanApproval(Request $request){
		$loan = Loan::where('id', '=', $request->_id)->first();
		$user = User::where('id', '=', $loan->user_id)->first();

		$remarks = $request->remarks;
		
	  	$emailContent = "";
	  	$coopname = $this->coop->coop_name;

	  	if($request->_status == 'approve'){
	  		$emailContent = "email.approve_loan";
	  	} else if ($request->_status == 'reject'){
	  		$emailContent = "email.reject_loan";
	  	}

        Mail::send($emailContent, ['user' => $user, 'loan' => $loan, 'coop' => $this->coop, 'remarks' => $remarks], function ($message) use ($user, $coopname)
        {
            $message->from('administrator@mabuhaybnhs.com', $coopname);
            $message->to($user->email);
            $message->subject('Loan Application');
        });

        $loanUpdate = Loan::findOrFail($request->_id);
    	$msg = "";

		if($request->_status == "approve"){
			$loanUpdate->status = "Active";
			// $loanUpdate->remaining_balance = $request->_remBal;

			if($loan->loan_type == "Cash"){
				$loanUpdate->due_date = Carbon::now()->addMonths(6)->format('Y-m-d H:i:s'); //6months
			} else if ($loan->loan_type == "Motor"){
				$loanUpdate->due_date = Carbon::now()->addMonths(36)->format('Y-m-d H:i:s'); //36months
			}
			
			if($loan->type == "d"){
	        	$sharecap = new MonthlyContribution;

	        	$sharecap->user_id = $loan->user_id;
	        	$sharecap->payment_id = "3";
	        	$sharecap->date = date('Y-m-d H:i:s');
	        	$sharecap->amount = $loan->scapital_amount;
	        	$sharecap->payment_type = "Cash";
	        	$sharecap->receipt_no = date('mdY-Hmss');
	        	$sharecap->date_paid = date('Y-m-d H:i:s');
	        	$sharecap->updated_by = Auth::user()->id;

	        	$sharecap->save();
	        }

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

	public function loanReminder($id){
		$loan = Loan::select('id', 'transaction_no', 'due_date', 'user_id')
		->where('id', '=', $id)->first();

		$ddate = Carbon::parse($loan->due_date);
		$due_date = $ddate->format('F d, Y');
		$due_date_sms = $ddate->format('m/d/Y');

		$user = User::where('id', '=', $loan->user_id)->first();

	  	$emailContent = "email.remind_loan";
	  	$coopname = $this->coop->coop_name;

        Mail::send($emailContent, ['user' => $user, 'loan' => $loan, 'coop' => $this->coop, 'due_date' => $due_date], function ($message) use ($user, $coopname)
        {
            $message->from('administrator@mabuhaybnhs.com', $coopname);
            $message->to($user->email);
            $message->subject('Loan Reminder');
        });

        $smsmsg = $user->f_name.", your loan ".$loan->transaction_no." for ".$this->coop->coop_name." will be due on ".$due_date_sms.".";

        $result = $this->itexmo($user->phone,$smsmsg,"TR-CARIS178289_J2DJP");
		if ($result == ""){
			echo "iTexMo: No response from server!!!
		Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
		Please CONTACT US for help. ";	
		} else if ($result == 0){
			echo "Message Sent!";
		}
		else{	
			echo "Error Num ". $result . " was encountered!";
		}

        
		return Redirect::route('officer.loan.index')->withFlashMessage('Loan Reminder sent successfully');
	}

	public function announcementReminder($id){
		$announcement = Announcement::select('id', 'event_date', 'details')
		->where('id', '=', $id)->first();

		$edate = Carbon::parse($announcement->event_date);
		$event_date = $edate->format('F d, Y');
		$event_date_sms = $edate->format('m/d/Y');

		$user = User::where('status', '=', 'active')
		// ->where('id', '4')
		->get();

		$user_tmp = User::where('status', '=', 'active')
		->whereIn('id', ['5', '1'])
		->get();

	  	$emailContent = "email.remind_announcement";
	  	$coopname = $this->coop->coop_name;

	  	if ($user->count() > 1)
	  	{
	  		foreach($user as $u) {
	  			Mail::send($emailContent, ['f_name' => $u->f_name, 'announcement' => $announcement, 'coop' => $this->coop, 'event_date' => $event_date], function ($message) use ($u, $coopname)
		        {
		            $message->from('administrator@mabuhaybnhs.com', $coopname);
		            $message->to($u->email);
		            $message->subject('Announcement');
		        });

		        //send SMS - activate if implemented (with unlimited SMS)
		        $smsmsg = $this->coop->coop_name.": ".$announcement->details." on ".$event_date_sms.".";

		        $result = $this->itexmo($u->phone,$smsmsg,"TR-CARIS178289_J2DJP");
				if ($result == ""){
					echo "iTexMo: No response from server!!!
				Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
				Please CONTACT US for help. ";	
				} else if ($result == 0){
					echo "Message Sent!";
				}
				else{	
					echo "Error Num ". $result . " was encountered!";
				}
            }

            //temporary only - send SMS announcement to selected people
     //        if ($user_tmp->count() > 1)
		  	// {
		  	// 	foreach($user_tmp as $ut) {
			  //       //send SMS
			  //       $smsmsg = $this->coop->coop_name.": ".$announcement->details." on ".$event_date_sms.".";

			  //       $result = $this->itexmo($ut->phone,$smsmsg,"TR-CARIS178289_J2DJP");
					// if ($result == ""){
					// 	echo "iTexMo: No response from server!!!
					// Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
					// Please CONTACT US for help. ";	
					// } else if ($result == 0){
					// 	echo "Message Sent!";
					// }
					// else{	
					// 	echo "Error Num ". $result . " was encountered!";
					// }
	    //         }
		  	// }

	  	} elseif ($user->count() > 0)
	  	{
	  		Mail::send($emailContent, ['f_name' => $user[0]->f_name, 'announcement' => $announcement, 'coop' => $this->coop, 'event_date' => $event_date], function ($message) use ($user, $coopname)
	        {
	            $message->from('administrator@mabuhaybnhs.com', $coopname);
	            $message->to($user[0]->email);
	            $message->subject('Announcement');
	        });

	        //send SMS
	        $smsmsg = $this->coop->coop_name.": ".$announcement->details." on ".$event_date_sms.".";

	        $result = $this->itexmo($user[0]->phone,$smsmsg,"TR-CARIS178289_J2DJP");
			if ($result == ""){
				echo "iTexMo: No response from server!!!
			Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
			Please CONTACT US for help. ";	
			} else if ($result == 0){
				echo "Message Sent!";
			}
			else{	
				echo "Error Num ". $result . " was encountered!";
			}
	  	}
        
		return Redirect::route('officer.announcements.index')->withFlashMessage('Announcement Reminder sent successfully');
	}

	public function itexmo($number,$message,$apicode){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
		$param = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($itexmo),
		    ),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
	}
}