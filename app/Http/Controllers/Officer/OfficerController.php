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
use App\Cooperative;
use App\User;
use App\MonthlyContribution;
use App\Loan;
use App\Http\Controllers\BaseController;

class OfficerController extends BaseController
{
    
    public function index()
	{
		return view('officer.index');
	}

	public function monthlyContribution()
	{
		if($this->position != 'Treasurer' && Auth::user()->id != '1'){
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
			$start_year = new DateTime("2014-05-01");
			$end_year = new DateTime(date('Y-m-d'));
			$end_year->add(new DateInterval("P1Y"));
			$interval_year = DateInterval::createFromDateString('1 year');
			$period_year   = new DatePeriod($start_year, $interval_year, $end_year);

			$years = array();

			foreach ($period_year as $year) {
			    array_push($years,  $year->format("Y"));
			}

			rsort($years);
	 	
			//dd($contributions);

			return view('officer.contribution.monthly', compact('contributions', 'months', 'years', 'users', 'selected_year', 'selected_month', 'payment'));
		}

	}

	public function monthlyContributionYearSelected(Request $request)
	{
		if($this->position != 'Treasurer' && Auth::user()->id != '1'){
			return Redirect::route('forbidden');
		}else{
			return Redirect::route('officer.contribution.monthly', ['y'=>$request->year, 'm'=>$request->month]);
		}
	}

	public function monthlyContributionInfo(Request $request)
	{
		if($this->position != 'Treasurer' && Auth::user()->id != '1'){
			return Redirect::route('forbidden');
		}else{
			$data= $request->id;
	     	return response()->json($data);
	    }
	}

	public function storeContribution(Request $request)
	{
		if($this->position != 'Treasurer' && Auth::user()->id != '1'){
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
	        } else  if ($request->payment_id == '2') {
	        	$dt = DateTime::createFromFormat('Y', $request->date);
	        	$cont->date = $dt->format('Y-m-d H:i:s');
	        } else {
	        	$cont->date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date)));
	        }

	        // dd($request->date_paid);
	        
	        $cont->amount = $request->amount;
	        $cont->payment_type = $request->payment_type;
	        $cont->receipt_no = $request->receipt_no;
	        $cont->date_paid = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date_paid)));
	        $cont->updated_by = Auth::user()->id;

	        $cont->save();
	        
	        if($request->payment_id == '1'){
	        	return Redirect::route('officer.contribution.monthly', ['y' => $request->_year, 'm' => $request->_month])->withFlashMessage('Contribution was added');
	        } else if ($request->payment_id == '2') {
	        	return Redirect::route('officer.contribution.damayan', ['y' => $request->_year, 'm' => $request->_month])->withFlashMessage('Contribution was added');
	        } else if ($request->payment_id == '3') {

	        }
	    }
		
	} 

	public function damayanContribution()
	{
		if($this->position != 'Treasurer' && Auth::user()->id != '1'){
			return Redirect::route('forbidden');
		}else{
			
			$users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')->where('status', 'active')->whereNotIn('id', [Auth::user()->id])->orderBy('l_name')->pluck('fullName', 'id');

			$payment = DB::table('payments')
			->select('id')
			->where('payment', '=', 'Damayan')
			->first();

			$damayan = DB::table('users')
	        ->join('contributions', 'users.id', '=', 'contributions.user_id')
	        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.date')
	       	->where('payments.payment', '=', 'Damayan')
	        ->get();

			return view('officer.contribution.damayan', compact('damayan', 'payment', 'users'));
		}
	}

	public function sharecapitalContribution()
	{
		if($this->position != 'Treasurer' && Auth::user()->id != '1'){
			return Redirect::route('forbidden');
		}else{
			// $coop = Cooperative::whereNotNull('id')->first();

			// $users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')->where('status', 'active')->whereNotIn('id', [Auth::user()->id])->orderBy('l_name')->pluck('fullName', 'id');

			$users = DB::table('users')
			->select(
				DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),
				'id')
			->where('status', '=', 'active')
			->whereNotIn('id', [Auth::user()->id])
			->whereNotIn('id', function($query){
			    $query->select('user_id')
			    ->from('contributions')
			    ->join('payments', 'contributions.payment_id', '=', 'payments.id')
			    ->where('payments.payment', '=', 'Share Capital');
			})
			->orderBy('l_name')
			->pluck('fullName', 'id');

			$payment = DB::table('payments')
			->select('id')
			->where('payment', '=', 'Share Capital')
			->first();

			$sharecapital = DB::table('users')
	        ->join('contributions', 'users.id', '=', 'contributions.user_id')
	        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
	        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.date')
	       	->where('payments.payment', '=', 'Share Capital')
	        ->get();

			return view('officer.contribution.sharecapital', compact('users', 'payment', 'sharecapital'));
		}
	}

	public function loan()
    {
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

        $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->select('loans.user_id', 'users.f_name', 'users.l_name', 'loans.transaction_no', 'loans.date_applied', 'loans.status', 'loans.amount_loan', 'loans.amount_paid', 'loans.remaining_balance', 'loans.due_date', 'loans.id')
        ->where('user_id', '!=', Auth::user()->id)
        ->whereIn('loans.status', $statFilter)
        ->get();

        return view('officer.loan.index', compact('loans', 'stat', 'status_filter'));
    }

    public function loanFilter(Request $request)
    {
        return Redirect::route('officer.loan.index', ['s'=>$request->statusFilter]);
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
}