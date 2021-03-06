<?php

namespace App\Http\Controllers\Officer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Auth;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use Storage;
use File;
use App\FilesUploaded;
use App\Cooperative;
use App\User;
use App\MonthlyContribution;
use App\Loan;
use App\Http\Controllers\BaseController;
use App\LoanPayment;
use Inani\Larapoll\Poll;
use App\Announcement;
use Carbon\Carbon;

class OfficerController extends BaseController
{
    
    public function index()
	{
		$loanMonthly = DB::table('loan_payments')
		->join('loans', 'loan_payments.transaction_no', '=', 'loans.transaction_no')
		->select(
			DB::raw('\'Loan\' AS type'),
			DB::raw('SUM(loan_payments.interest_amount) AS amount'),
			DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid)) as monthname')
		)
		->whereIn('status', ['Active', 'Paid'])
		->orderBy(DB::raw('month(date_paid)'), 'asc')
		->groupBy(DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid))'))
		->get();

		$businessMonthly = DB::table('business_incomes')
		->select(
			DB::raw('\'Business\' AS type'),
			DB::raw('SUM(profit) AS amount'),
			DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid)) as monthname')
		)
		->orderBy(DB::raw('month(date_paid)'), 'asc')
		->groupBy(DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid))'))
		->get();

		$loanM = DB::table('loan_payments')
		->join('loans', 'loan_payments.transaction_no', '=', 'loans.transaction_no')
		->select(
			DB::raw('NULL AS amountbusiness'),
			DB::raw('SUM(loan_payments.interest_amount) AS amountloan'),
			DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid)) as monthname')
		)
		->whereIn('status', ['Active', 'Paid'])
		->orderBy(DB::raw('month(date_paid)'), 'asc')
		->groupBy(DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid))'));

		$businessM = DB::table('business_incomes')
		->select(
			DB::raw('SUM(profit) AS amountbusiness'),
			DB::raw('NULL AS amountloan'),
			DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid)) as monthname')
		)
		->orderBy(DB::raw('month(date_paid)'), 'asc')
		->groupBy(DB::raw('CONCAT(monthname(date_paid), \' \',  year(date_paid))'));

		$monthly = $loanM->union($businessM)->get();

		//YEARLY

		$loanYearly = DB::table('loan_payments')
		->join('loans', 'loan_payments.transaction_no', '=', 'loans.transaction_no')
		->select(
			DB::raw('\'Loan\' AS type'),
			DB::raw('SUM(loan_payments.interest_amount) AS amount'),
			DB::raw('year(date_paid) as yearname')
		)
		->whereIn('status', ['Active', 'Paid'])
		->groupBy(DB::raw('year(date_paid)'))
		->get();

		$businessYearly = DB::table('business_incomes')
		->select(
			DB::raw('\'Business\' AS type'),
			DB::raw('SUM(profit) AS amount'),
			DB::raw('year(date_paid) as yearname')
		)
		->groupBy(DB::raw('year(date_paid)'))
		->get();

		$loanY = DB::table('loan_payments')
		->join('loans', 'loan_payments.transaction_no', '=', 'loans.transaction_no')
		->select(
			DB::raw('year(date_paid) as yearname')
		)
		->whereIn('status', ['Active', 'Paid'])
		->groupBy(DB::raw('year(date_paid)'));

		$businessY = DB::table('business_incomes')
		->select(
			DB::raw('year(date_paid) as yearname')
		)
		->groupBy(DB::raw('year(date_paid)'));

		$yearly = $loanY->union($businessY)->get();

		return view('officer.index', compact('loanMonthly', 'businessMonthly', 'monthly', 'loanYearly', 'businessYearly', 'yearly'));
	}

	public function monthlyContribution()
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$curr_year = new DateTime(date('Y-m-d'));
			$paramYear = Input::get('y');
			$paramMonth = Input::get('m');
			$selected_year = "";
			$selected_month = "";

			if ($paramYear != '') {
	        	$selected_year = $paramYear;
	        } else {
	        	$selected_year = $curr_year->format('Y');
	        }

	        if ($paramMonth != '') {
	        	$selected_month = $paramMonth;
	        } else {
	        	$selected_month = 'All';
	        }

			$users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')->where('status', 'active')->whereNotIn('id', [Auth::user()->id])->orderBy('l_name')->pluck('fullName', 'id');

			$payment = DB::table('payments')
			->select('id')
			->where('payment', '=', 'Monthly Contribution')
			->first();

	   		$contributions = DB::table('users')
	        ->join('contributions', 'users.id', '=', 'contributions.user_id')
	        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.date',
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'1\' THEN contributions.amount ELSE 0 END) AS January'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'2\' THEN contributions.amount ELSE 0 END) AS February'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'3\' THEN contributions.amount ELSE 0 END) AS March'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'4\' THEN contributions.amount ELSE 0 END) AS April'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'5\' THEN contributions.amount ELSE 0 END) AS May'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'6\' THEN contributions.amount ELSE 0 END) AS June'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'7\' THEN contributions.amount ELSE 0 END) AS July'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'8\' THEN contributions.amount ELSE 0 END) AS August'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'9\' THEN contributions.amount ELSE 0 END) AS September'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'10\' THEN contributions.amount ELSE 0 END) AS October'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'11\' THEN contributions.amount ELSE 0 END) AS November'),
	        DB::raw('SUM(CASE WHEN month(contributions.date) = \'12\' THEN contributions.amount ELSE 0 END) AS December')
	    	)
	       	->whereYear('contributions.date', '=', $selected_year)
	       	->where('payments.payment', '=', 'Monthly Contribution')
	        ->groupBy('contributions.user_id', 'users.id', 'users.f_name', 'users.l_name')
	        ->get();

	        //get list of months
	        $curr_date = new DateTime(date('Y-m-d'));
	       	$date_founded = new DateTime(date($this->coop->date_founded));

	       	$months = array();

	       	if ($curr_date->format('Y') == $date_founded->format('Y') || $selected_year == $date_founded->format('Y')) {
	       		//get list of months for the year founded
	       		$end_month = new DateTime($date_founded->format('Y').'-12-31');
	       		$interval_month = DateInterval::createFromDateString('1 month');
				$period_month   = new DatePeriod($date_founded, $interval_month, $end_month);

				foreach ($period_month as $m) {
				    array_push($months,  $m->format("F"));
				}
	       	} else {
	       		for ($m=1; $m<=12; $m++) {
					$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
					array_push($months,  $month);
			    }
	       	}

			//get list of years since COOP founded date
			$start_year = $date_founded;
			$end_year = new DateTime(date('Y-m-d'));

			// if ($curr_date->format('Y') != $date_founded->format('Y')){
			// 	$end_year->add(new DateInterval("P1Y"));
			// }

			$interval_year = DateInterval::createFromDateString('1 year');
			$period_year   = new DatePeriod($start_year, $interval_year, $end_year);

			$years = array();

			foreach ($period_year as $year) {
			    array_push($years,  $year->format("Y"));
			}

			rsort($years);
	 	
			// dd($years);

			return view('officer.contribution.monthly', compact('contributions', 'months', 'years', 'users', 'selected_year', 'selected_month', 'payment'));
		}

	}

	public function monthlyMemberContribution($id)
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$curr_year = new DateTime(date('Y-m-d'));
			$paramYear = Input::get('y');
			$paramMonth = Input::get('m');
			$selected_year = "";
			$selected_month = "";
			$contributions = "";

			if ($paramYear != '') {
	        	$selected_year = $paramYear;
	        } else {
	        	$selected_year = $curr_year->format('Y');
	        }

	         if ($paramMonth != '' && $paramMonth != 'All') {
	        	$selected_month = $paramMonth;

	        	$contributions = DB::table('users')
	            ->join('contributions', 'users.id', '=', 'contributions.user_id')
	            ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	            ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id',
	            	DB::raw('monthname(contributions.date) AS month'),
	            	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE contributions.updated_by = users.id) AS updated_by")
	            )
	           	->whereYear('contributions.date', '=', $selected_year)
	           	->where(DB::raw('monthname(contributions.date)'), '=', $selected_month)
	           	->where('contributions.user_id', '=', $id)
	           	->where('payments.payment', '=', 'Monthly Contribution')
	            ->get();
	        } else {
	        	$selected_month = 'All';

	        	$contributions = DB::table('users')
	            ->join('contributions', 'users.id', '=', 'contributions.user_id')
	            ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	            ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id',
	            	DB::raw('monthname(contributions.date) AS month'),
	            	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE contributions.updated_by = users.id) AS updated_by")
	            )
	           	->whereYear('contributions.date', '=', $selected_year)
	           	->where('contributions.user_id', '=', $id)
	           	->where('payments.payment', '=', 'Monthly Contribution')
	            ->get();
	        }

	        //get list of months
	        $curr_date = new DateTime(date('Y-m-d'));
	       	$date_founded = new DateTime(date($this->coop->date_founded));

	       	$months = array();

	       	if ($curr_date->format('Y') == $date_founded->format('Y') || $selected_year == $date_founded->format('Y')) {
	       		//get list of months for the year founded
	       		$end_month = new DateTime($date_founded->format('Y').'-12-31');
	       		$interval_month = DateInterval::createFromDateString('1 month');
				$period_month   = new DatePeriod($date_founded, $interval_month, $end_month);

				foreach ($period_month as $m) {
				    array_push($months,  $m->format("F"));
				}
	       	} else {
	       		for ($m=1; $m<=12; $m++) {
					$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
					array_push($months,  $month);
			    }
	       	}

			//get list of years since COOP founded date
			$start_year = $date_founded;
			$end_year = new DateTime(date('Y-m-d'));

			// if ($curr_date->format('Y') != $date_founded->format('Y')){
			// 	$end_year->add(new DateInterval("P1Y"));
			// }
			
			$interval_year = DateInterval::createFromDateString('1 year');
			$period_year   = new DatePeriod($start_year, $interval_year, $end_year);

			$years = array();

			foreach ($period_year as $year) {
			    array_push($years,  $year->format("Y"));
			}

			rsort($years);

			$member = DB::table('users')
	            ->select('f_name', 'l_name')
	           	->where('id', '=', $id)
	            ->first();

			return view('officer.contribution.member.member_monthly', compact('contributions', 'months', 'years', 'selected_year', 'selected_month', 'id', 'member'));
		}

	}

	public function memberYearSelected(Request $request)
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			return Redirect::route('officer.contribution.monthly.member', [$request->_id, 'y' => $request->year, 'm'=>$request->month]);
		}
	}

	public function monthlyContributionYearSelected(Request $request)
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			if($request->_payment == '1'){
	        	return Redirect::route('officer.contribution.monthly', ['y' => $request->year, 'm' => $request->month]);
	        } else if ($request->_payment == '2') {
	        	return Redirect::route('officer.contribution.damayan', ['y' => $request->year]);
	        } else if ($request->_payment == '3') {
	        	return Redirect::route('officer.contribution.sharecapital', ['y' => $request->year]);
	        }
		}
	}

	public function storeContribution(Request $request)
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$validator = Validator::make($data = Input::all(), MonthlyContribution::$rules);
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}

			$cont = new MonthlyContribution;

	        $cont->user_id = $request->user_id;
	        $cont->payment_id = $request->payment_id;

	        if ($request->payment_id == '1') {
	        	$dtmy = DateTime::createFromFormat('M Y', $request->date);
	        	$cont->date = $dtmy->format('Y-m-d H:i:s');
	        	$cont->date_paid = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date_paid)));
	        } else  if ($request->payment_id == '2') {
	        	$dt = DateTime::createFromFormat('Y', $request->date);
	        	$cont->date = $dt->format('Y-m-d H:i:s');
	        	$cont->date_paid = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date_paid)));
	        } else {
	        	$cont->date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date)));
	        	$cont->date_paid = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date)));
	        }

	        // dd($request->date_paid);
	        
	        $cont->amount = $request->amount;
	        $cont->payment_type = $request->payment_type;
	        $cont->receipt_no = $request->receipt_no;
	        $cont->updated_by = Auth::user()->id;

	        $cont->save();

	        $contReceipt = DB::table('contributions')
        	->join('payments', 'contributions.payment_id', '=', 'payments.id')
        	->select('amount', 'payment_type', 'receipt_no', 'date_paid', 'payment', 
        		DB::raw("CONCAT(monthname(date), ' ', year(date)) AS monthly"),
        		DB::raw("year(date) AS damayan"),
        		DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE user_id = users.id) AS user_id"),
        		DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE updated_by = users.id) AS updated_by")
        	)
        	->where('contributions.id', $cont->id)
        	->first();

        	// return view('officer.contribution.receipt', compact('contReceipt'));
	        
	        if($request->payment_id == '1'){
	        	return Redirect::route('officer.contribution.monthly', ['y' => $request->_year, 'm' => $request->_month])->withFlashMessage('Contribution was added');
	        } else if ($request->payment_id == '2') {
	        	return Redirect::route('officer.contribution.damayan', ['y' => $request->_year])->withFlashMessage('Contribution was added');
	        } else if ($request->payment_id == '3') {
	        	return Redirect::route('officer.contribution.sharecapital', ['y' => $request->_year])->withFlashMessage('Contribution was added');
	        }
	    }	
	} 

	public function damayanContribution()
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$curr_year = new DateTime(date('Y-m-d'));
			$paramYear = Input::get('y');
			$selected_year = "";

			if ($paramYear != '') {
	        	$selected_year = $paramYear;
	        } else {
	        	$selected_year = $curr_year->format('Y');
	        }

			$users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')->where('status', 'active')->whereNotIn('id', [Auth::user()->id])->orderBy('l_name')->pluck('fullName', 'id');

			$payment = DB::table('payments')
			->select('id')
			->where('payment', '=', 'Damayan')
			->first();

			$damayan = DB::table('users')
	        ->join('contributions', 'users.id', '=', 'contributions.user_id')
	        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.date', 'contributions.amount', 'contributions.date_paid',
	        	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE contributions.updated_by = users.id) AS updated_by")
	    	)
	       	->where('payments.payment', '=', 'Damayan')
	       	->whereYear('contributions.date', '=', $selected_year)
	        ->get();

	        //get list of years since COOP founded date
	        $curr_date = new DateTime(date('Y-m-d'));
	       	$date_founded = new DateTime(date($this->coop->date_founded));

			$start_year = $date_founded;
			$end_year = new DateTime(date('Y-m-d'));

			// if ($curr_date->format('Y') != $date_founded->format('Y')){
			// 	$end_year->add(new DateInterval("P1Y"));
			// }

			$interval_year = DateInterval::createFromDateString('1 year');
			$period_year   = new DatePeriod($start_year, $interval_year, $end_year);

	        $years = array();

			foreach ($period_year as $year) {
			    array_push($years,  $year->format("Y"));
			}

			rsort($years);

			return view('officer.contribution.damayan', compact('damayan', 'payment', 'users', 'years', 'selected_year'));
		}
	}

	public function sharecapitalContribution()
	{
		if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$curr_year = new DateTime(date('Y-m-d'));
			$paramYear = Input::get('y');
			$selected_year = "";

			if ($paramYear != '') {
	        	$selected_year = $paramYear;
	        } else {
	        	$selected_year = $curr_year->format('Y');
	        }

			$users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')->where('status', 'active')->whereNotIn('id', [Auth::user()->id])->orderBy('l_name')->pluck('fullName', 'id');

			$payment = DB::table('payments')
			->select('id')
			->where('payment', '=', 'Share Capital')
			->first();

			$sharecapital = DB::table('users')
	        ->join('contributions', 'users.id', '=', 'contributions.user_id')
	        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.date', 'contributions.amount', 'contributions.date_paid',
	        	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE contributions.updated_by = users.id) AS updated_by")
	    	)
	       	->where('payments.payment', '=', 'Share Capital')
	       	->whereYear('contributions.date', '=', $selected_year)
	        ->get();

	        //get list of years since COOP founded date
	        $curr_date = new DateTime(date('Y-m-d'));
	       	$date_founded = new DateTime(date($this->coop->date_founded));

			$start_year = $date_founded;
			$end_year = new DateTime(date('Y-m-d'));

			// if ($curr_date->format('Y') != $date_founded->format('Y')){
			// 	$end_year->add(new DateInterval("P1Y"));
			// }

			$interval_year = DateInterval::createFromDateString('1 year');
			$period_year   = new DatePeriod($start_year, $interval_year, $end_year);

	        $years = array();

			foreach ($period_year as $year) {
			    array_push($years,  $year->format("Y"));
			}

			rsort($years);

			return view('officer.contribution.sharecapital', compact('sharecapital', 'payment', 'users', 'years', 'selected_year'));
		}
	}

	public function loan()
    {
    	if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
	        $status_filter = Input::get('s');
	        $statFilter = array();
	        $cashLoan = "false";
	        $loanable = "false";

	        $stat = DB::table('loans')
	        ->select(DB::raw("DISTINCT status"))
	        ->pluck('status');

	        // dd($stat);

	        if($status_filter == 'all' || $status_filter == ''){
	            foreach($stat as $s) {
	                array_push($statFilter, $s);
	            }
	        }else{
	            array_push($statFilter,  $status_filter);
	        }

	         if($this->position == 'Treasurer'){
	         	$userPres = DB::table('loans')
		        ->join('users', 'loans.user_id', '=', 'users.id')
		        ->leftJoin('officers', 'loans.user_id', '=', 'officers.user_id')
		        ->leftJoin('positions', 'officers.position_id', '=', 'positions.id')
		        ->select('officers.user_id')
		    	->where('positions.position', 'President')
		        ->where('officers.status', 'active')
		        ->where('loans.status', 'pending')
		        ->first();

		        if($userPres != '' || $userPres != null){
		        	$allowedId = $userPres->user_id;
		        }else{
		        	$allowedId = '0';
		        }
	        }

	        $loans = DB::table('loans')
	        ->join('users', 'loans.user_id', '=', 'users.id')
	        ->select('loans.user_id', 'users.f_name', 'users.l_name', 'loans.transaction_no', 'loans.date_applied', 'loans.status', 'loans.amount_loan', 'loans.amount_paid', 'loans.remaining_balance', 'loans.amount_repayable', 'loans.interest_amount_paid', 'loans.scapital_amount', 'loans.scapital_amount_paid', 'loans.due_date', 'loans.id', 'loans.interest_amount', 'loans.reviewed_at', 'loans.remarks', 'loans.id', 'loans.loan_type',
	        	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE loans.reviewed_by = users.id) AS reviewed_by")
	    	)
	        ->where('loans.user_id', '!=', Auth::user()->id)
	        ->whereIn('loans.status', $statFilter)
	        ->get();

	        $transNo = DB::table('loans')
	        ->select('transaction_no','transaction_no')
	        ->where('status', 'Active')
	        ->whereNotIn('id', [Auth::user()->id])
	        ->orderBy('transaction_no')
	        ->pluck('transaction_no', 'transaction_no');


	        // dd($allowedId);

	        return view('officer.loan.index', compact('loans', 'stat', 'status_filter', 'transNo', 'allowedId'));
	    }
    }

    public function loanFilter(Request $request)
    {
    	if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
       		return Redirect::route('officer.loan.index', ['s'=>$request->statusFilter]);
       	}
    }

    public function loanApproval(Request $request){

  //   	$loan = Loan::findOrFail($request->_id);
  //   	$msg = "";

		// if($request->_status == "approve"){
		// 	$loan->status = "Approve";
		// 	$loan->remaining_balance = $request->_remBal;
		// } else if($request->_status == "reject"){
		// 	$loan->status = "Rejected";
		// 	$loan->remarks = $request->remarks;
		// } else {
		// 	return Redirect::route('admin.admin.index')->withFlashMessage('No changes was made');
		// }

		// $loan->reviewed_by = Auth::user()->id;
		// $loan->reviewed_at = date('Y-m-d H:i:s');
		
  //       $loan->update();

  //       if($request->_status == "approve"){
		// 	$msg = "Loan application was approve";
		// } else if($request->_status == "reject"){
		// 	$msg = "Loan application was rejected";
		// }

  //       return Redirect::route('officer.loan.index')->withFlashMessage($msg);
    }

    public function loanPaymentView($trans){
    	if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$loans = DB::table('loans')
	        ->join('users', 'loans.user_id', '=', 'users.id')
	        ->select('loans.user_id', 'users.f_name', 'users.l_name', 'loans.transaction_no', 'loans.date_applied', 'loans.status', 'loans.type', 'loans.amount_loan', 'loans.amount_paid', 'loans.remaining_balance', 'loans.amount_repayable', 'loans.interest_amount_paid', 'loans.scapital_amount', 'loans.scapital_amount_paid', 'loans.due_date', 'loans.id', 'loans.interest_amount', 'loans.reviewed_at', 'loans.remarks', 'loans.id', 'loans.loan_type',
	        	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE loans.reviewed_by = users.id) AS reviewed_by")
	    	)
	        ->where('loans.user_id', '!=', Auth::user()->id)
	        ->where('transaction_no', $trans)
	        ->first();

	        $to = Carbon::createFromFormat('Y-m-d H:s:i', $loans->due_date);
			// $from = Carbon::createFromFormat('Y-m-d H:s:i', '2018-11-1 9:30:34');
      
			$months = $to->diffInMonths(date('Y-m-d H:i:s'));
			if($months == 0){
				$months = 1;
			}

	        $amount_due = $loans->remaining_balance / $months;
	        $amount_due = number_format((float)$amount_due, 2, '.', '');

	        $int = 0;
	        $sh = 0;
	        $minimum = 0;

	        if($loans->loan_type == "Cash"){
	        	if($loans->type == "a"){
		        	$int = ($loans->interest_amount - $loans->interest_amount_paid) / $months;
		        	$sh = ($loans->scapital_amount - $loans->scapital_amount_paid) / $months;
		        	$minimum = $int + $sh;
		        	$minimum = number_format((float)$minimum, 2, '.', '');
		        } else if ($loans->type == "d") {
		        	$minimum = 1;
		        }
	        } else if ($loans->loan_type == "Motor"){
	        	$int = ($loans->interest_amount - $loans->interest_amount_paid) / $months;
	        	$minimum = number_format((float)$int, 2, '.', '');
	        }
	        
		}

    	return view('officer.loan.payment', compact('loans', 'amount_due', 'minimum', 'int', 'sh'));
    }

    public function loanPayment(Request $request){
    	if($this->position != 'Treasurer' && $this->position != 'President' && Auth::user()->role_id != '4'){
			return Redirect::route('forbidden');
		}else{
			$validator = Validator::make($data = Input::all(), LoanPayment::$rules);
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}

			$loanInfo = DB::table('loans')
        	->select('amount_paid', 'interest_amount', 'id', 'remaining_balance', 'user_id', 'type', 'interest_amount_paid', 'scapital_amount_paid', 'amount_repayable', 'loan_type')
        	->where('transaction_no', $request->transaction_no)
        	->first();

			$loanPay = new LoanPayment;

			$_amount = 0;

	        $loanPay->transaction_no = $request->transaction_no;

	        if($loanInfo->loan_type == "Cash"){
	        	if($loanInfo->type == "a"){
		        	$loanPay->interest_amount = $request->interest;
		        	$loanPay->sharecap_amount = $request->sharecap;
		        	$_amount = $request->amount - $request->minimum;
		        } else if ($loanInfo->type == "d"){
		        	$_amount = $request->amount;
		        }
	        } else if ($loanInfo->loan_type == "Motor"){
	        	$loanPay->interest_amount = $request->interest;
	        	$_amount = $request->amount - $request->minimum;
	        }
	        
	        $loanPay->amount = $_amount;
	        
	        $loanPay->date_paid = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date_paid)));
	        $loanPay->payment_type = $request->payment_type;
	        $loanPay->receipt_no = $request->receipt_no;
	        $loanPay->updated_by = Auth::user()->id;

	        $loanPay->save();

	        //add sharecapital payment to sharecapital contributions
	        if($loanInfo->type == "a"){
	        	$sharecap = new MonthlyContribution;

	        	$sharecap->user_id = $loanInfo->user_id;
	        	$sharecap->payment_id = "3";
	        	$sharecap->date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date_paid)));
	        	$sharecap->amount = $request->sharecap;
	        	$sharecap->payment_type = $request->payment_type;
	        	$sharecap->receipt_no = $request->receipt_no;
	        	$sharecap->date_paid = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date_paid)));
	        	$sharecap->updated_by = Auth::user()->id;

	        	$sharecap->save();
	        }

        	$loan = Loan::findOrFail($loanInfo->id);
        	$amount_paid = 0;

        	if($loanInfo->loan_type == "Cash"){
        		if($loanInfo->type == "a"){
		        	$amount_paid = $request->amount - $request->minimum;
		        	$t_int = $loanInfo->interest_amount_paid + $request->interest;
		        	$t_sh = $loanInfo->scapital_amount_paid + $request->sharecap;

		        	$loan->interest_amount_paid = $t_int;
		        	$loan->scapital_amount_paid = $t_sh;
		        	$loan->remaining_balance = $loanInfo->amount_repayable - (($loanInfo->amount_paid + $amount_paid) + $t_sh + $t_int);
		        } else if ($loanInfo->type == "d"){
		        	$amount_paid = $request->amount;
		        	$loan->remaining_balance = $loanInfo->amount_repayable - (($loanInfo->amount_paid + $amount_paid) + $loanInfo->interest_amount_paid + $loanInfo->scapital_amount_paid);
		        }
        	} else if ($loanInfo->loan_type == "Motor"){
        		$amount_paid = $request->amount - $request->minimum;
	        	$t_int = $loanInfo->interest_amount_paid + $request->interest;

	        	$loan->interest_amount_paid = $t_int;
	        	$loan->remaining_balance = $loanInfo->amount_repayable - (($loanInfo->amount_paid + $amount_paid) + $t_int);
        	}

	        $loan->amount_paid = $loanInfo->amount_paid + $amount_paid;

        	if($loanInfo->amount_paid > 0){
        		$amount_paid = $loanInfo->amount_paid + $request->amount;
        	}else{
        		$amount_paid = $request->amount;
        	}

        	

        	// if($request->interest_amount != '' || $request->interest_amount != null){
        	// 	if($loanInfo->interest_amount > 0){
	        // 		$intAmount = $loanInfo->interest_amount + $request->interest_amount;
	        // 	}else{
	        // 		$intAmount = $request->interest_amount;
	        // 	}

	        // 	$loan->interest_amount = $intAmount;
        	// }
        	
        	$loan->update();

        	$loanUpdated = Loan::findOrFail($loanInfo->id);

        	if($loanUpdated->remaining_balance == "0.0" || $loanUpdated->remaining_balance == "0" || $loanUpdated->remaining_balance == "0.00"){
        		$loanUpdated->status = "Paid";

        		$loanUpdated->update();
        	}

        	$loanReceipt = DB::table('loan_payments')
        	->join('loans', 'loans.transaction_no', '=', 'loan_payments.transaction_no')
        	->select('loan_payments.transaction_no', 'amount', 'loan_payments.interest_amount', 'sharecap_amount', 'date_paid', 'payment_type', 'receipt_no',
        		DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE loans.user_id = users.id) AS user_loan"),
        		DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE updated_by = users.id) AS updated_by")
        	)
        	->where('loan_payments.id', $loanPay->id)
        	->first();

        	return view('officer.loan.receipt', compact('loanReceipt'));
	        
	        // return Redirect::route('officer.loan.index')->withFlashMessage('Payment was added');
	    }
    }

    public function businessList(){
    	$status_filter = Input::get('s');
        $statFilter = array();

        $stat = DB::table('businesses')
        ->select(DB::raw("DISTINCT status"))
        ->pluck('status');

        if($status_filter == 'all' || $status_filter == ''){
            foreach($stat as $s) {
                array_push($statFilter, $s);
            }
        }else{
            array_push($statFilter,  $status_filter);
        }

        $business = DB::table('businesses')
         ->select('id', 'name', 'description', 'businesses.status', 'capital', 'date_started', 'income', 'profit',
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE businesses.added_by = users.id) AS added_by"),
            'date_ended',
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE businesses.removed_by = users.id) AS removed_by"),
            'remarks'
        )
        ->whereIn('status', $statFilter)
        -> get();

        return view('officer.business.index', compact('business', 'stat', 'status_filter'));
    }

    public function businessFilter(Request $request)
    {
        return Redirect::route('officer.business.index', ['s'=>$request->statusFilter]);
    }

    public function indexMember()
	{
		$selected_filter = Input::get('f');
		$status_filter = Input::get('s');
		$members = '';
		$statFilter = array();

		if($status_filter == 'all' || $status_filter == ''){
			array_push($statFilter,  "active");
			array_push($statFilter,  "inactive");
		}else{
			array_push($statFilter,  $status_filter);
		}

		if ($selected_filter != '') {
			$members = DB::table('users')
			->select('users.id', 'f_name', 'l_name', 'm_name', 'phone', 'address', 'status', 'role_id', 'avatar',
				DB::raw("(CASE role_id 
						WHEN 1 THEN 'Admin' 
						WHEN 3 THEN 'Member' 
						WHEN 2 THEN 
							(CASE (SELECT o.status FROM officers o WHERE o.status = 'active' AND user_id = users.id) 
							WHEN 'active'
							THEN (SELECT p.position FROM officers o JOIN positions p ON o.position_id = p.id WHERE o.status = 'active' AND o.user_id = users.id)
							END)
						END) AS description"),
				DB::raw("YEAR(activated_at) as activated_at")
	        )
			->where('l_name', 'like', $selected_filter.'%')
			->whereIn('users.status', $statFilter)
			->orderBy('l_name', 'asc')
			->get();
        } else {
			$members = DB::table('users')
			->select('users.id', 'f_name', 'l_name', 'm_name', 'phone', 'address', 'status', 'role_id', 'avatar',
				DB::raw("(CASE role_id 
						WHEN 1 THEN 'Admin' 
						WHEN 3 THEN 'Member' 
						WHEN 2 THEN 
							(CASE (SELECT o.status FROM officers o WHERE o.status = 'active' AND user_id = users.id) 
							WHEN 'active'
							THEN (SELECT p.position FROM officers o JOIN positions p ON o.position_id = p.id WHERE o.status = 'active' AND o.user_id = users.id)
							END)
						END) AS description"),
				DB::raw("YEAR(activated_at) as activated_at")
			)
			->whereIn('users.status', $statFilter)
			->orderBy('l_name', 'asc')
			->get();
        }

		$filters = range('A', 'Z');

		return view('officer.member.index', compact('members', 'filters', 'selected_filter', 'status_filter'));
	}

	public function showMember($id)
	{
		
		$member = DB::table('users')
			->join('roles', 'users.role_id', '=', 'roles.id')
			->select('users.id', 'f_name', 'l_name', 'm_name', 'phone','gender', 'address', 'civil_status', 'email', 'avatar', 'status', 'roles.role_name',
				DB::raw("DATE_FORMAT(activated_at, '%M %d, %Y') as activated_at"),
				DB::raw("DATE_FORMAT(b_date, '%M %d, %Y') as b_date")
			)
			->where('users.id', '=', $id)
			->first();
		
		return view('officer.member.show', compact('member'));
	}

	public function memberFilter(Request $request)
	{
		return Redirect::route('officer.member.index', ['f'=>$request->filter, 's'=>$request->statusFilter]);
	}

	public function documentsList()
	{

        $docs = DB::table('files_uploaded')
        ->join('files_type', 'files_uploaded.type_id', '=', 'files_type.id')
         ->select('files_uploaded.id', 'files_type.type', 'orig_file_name', 'file_name', 'path',
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE files_uploaded.added_by = users.id) AS added_by"),
            'added_at'
        )
        ->where('status', 'active')
        ->whereIn('type', ['minutes', 'attendance'])
        ->get();

        $fileType = DB::table('files_type')
		->select('type', 'id')
		->whereIn('type', ['minutes', 'attendance'])
		->orderBy('type')
		->pluck('type', 'id');

        return view('officer.document.index', compact('docs', 'fileType'));
	}

	public function documentsAdd(Request $request)
    {
    	$fileReq = $request['docs'];

		$validator = Validator::make($request = Input::all(), FilesUploaded::$docs_rules);

		$validator->after(function ($validator) use ($fileReq) {
	    	if($fileReq == ''){
	    		$validator->errors()->add('docs', 'File is required.');
	    	}else{
	    		for($i=0; $i<count($_FILES['docs']['name']); $i++) {
	    			if($_FILES['docs']['type'][$i] != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && $_FILES['docs']['type'][$i] != 'application/pdf' && $_FILES['docs']['type'][$i] != 'application/msword'){
	    				$validator->errors()->add('docs', 'Document must be a file of type: docx, pdf');
	    			}
	    		}
	    	}
     
        });

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		if(count($_FILES['docs']['name']) > 0){

			for($i=0; $i<count($_FILES['docs']['name']); $i++) {
				$tmpFilePath = $_FILES['docs']['tmp_name'][$i];
				$fileName = $request['file_type']."-".date('Ymd-His').'-'.$_FILES['docs']['name'][$i];
			    $filePath = "uploads/documents/".$fileName;

			    $origFileName = $_FILES['docs']['name'][$i];

			   	move_uploaded_file($tmpFilePath, $filePath);

			   	$fileUpload = new FilesUploaded;
			    
			    $fileUpload->type_id = $request['file_type'];
			    $fileUpload->status = 'active';
			    $fileUpload->orig_file_name = $origFileName;
			    $fileUpload->file_name = $fileName;
			    $fileUpload->path = $filePath;
			    $fileUpload->added_by = Auth::user()->id;
			    $fileUpload->added_at = date('Y-m-d H:i:s');

			    $fileUpload->save();
			}
		}

        return Redirect::route('officer.documents.index')->withFlashMessage('Changes save successfully');
    }

    public function documentsDelete($file_id)
    {
    	$docs = DB::table('files_uploaded')
        ->select('path', 'file_name')
        ->where('status', 'active')
        ->where('id', $file_id)
        ->first();

    	if (file_exists($docs->path))
    	{
    		File::delete($docs->path);
    		DB::table('files_uploaded')->where('id', $file_id)->delete();

    		return Redirect::route('officer.documents.index')->withFlashMessage('File deleted successfully');
    	}else {
    		return Redirect::back()->withErrors('File Does not Exist');
    	} 
    }

    public function documentsDownload($file_id)
    {
    	$docs = DB::table('files_uploaded')
        ->select('path', 'file_name')
        ->where('status', 'active')
        ->where('id', $file_id)
        ->first();

    	if (file_exists($docs->path))
    	{
			return response()->download($docs->path);
    	}else {
    		return Redirect::back()->withErrors('File Does not Exist');
    	} 
    }

    public function announcementList()
	{

        $announcement = DB::table('announcements')
         ->select('id', 'details', 'created_at', 'updated_at',
            DB::raw("CONCAT(monthname(event_date), ' ', day(event_date), ', ', year(event_date)) AS event_date"),
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE created_by = users.id) AS created_by"),
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE updated_by = users.id) AS updated_by")
        )
        ->get();

        return view('officer.announcement.index', compact('announcement'));
	}

	public function announcementAdd(Request $request)
    {
        $announcement = new Announcement;

        $eventDate = DateTime::createFromFormat('M d, Y', $request->event_date);

        $announcement->event_date = $eventDate->format('Y-m-d');
        $announcement->details = $request->details;
        $announcement->created_by = Auth::user()->id;

        $announcement->save();

        return Redirect::route('officer.announcements.index')->withFlashMessage('Announcement was added');
    }

    public function announcementEdit($id)
    {
    	$announcement = DB::table('announcements')
        ->select('id', 'details',
        	DB::raw("CONCAT(monthname(event_date), ' ', day(event_date), ', ', year(event_date)) AS event_date")
    	)
        ->where('id', $id)
        ->first();

        return view('officer.announcement.edit', compact('announcement'));
    }

    public function announcementUpdate(Request $request)
    {
    	$announcement = Announcement::findOrFail($request->_id);

    	$eventDate = DateTime::createFromFormat('M d, Y', $request->event_date);

        $announcement->event_date = $eventDate->format('Y-m-d');
        $announcement->details = $request->details;
        $announcement->updated_by = Auth::user()->id;   

        $announcement->update();

        return Redirect::route('officer.announcements.index')->withFlashMessage('Announcement was updated');
    }

    public function announcementDelete(Request $request)
    {
    	DB::table('announcements')->where('id', $request->_id)->delete();

    	return Redirect::route('officer.announcements.index')->withFlashMessage('Announcement deleted successfully');
    }

}
