<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use App\Cooperative;
use App\User;
use App\MonthlyContribution;
use App\Loan;

class MemberController extends BaseController
{
    public function index()
	{
		return view('member.index');
	}

	public function monthlyContribution()
	{
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
            ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id',
            	DB::raw('monthname(contributions.date) AS month'))
           	->whereYear('contributions.date', '=', $selected_year)
           	->where(DB::raw('monthname(contributions.date)'), '=', $selected_month)
           	->where('contributions.user_id', '=', Auth::user()->id)
            ->get();
        } else {
        	$selected_month = 'All';

        	$contributions = DB::table('users')
            ->join('contributions', 'users.id', '=', 'contributions.user_id')
            ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id',
            	DB::raw('monthname(contributions.date) AS month'))
           	->whereYear('contributions.date', '=', $selected_year)
           	->where('contributions.user_id', '=', Auth::user()->id)
            ->get();
        }

        // dd($contributions);

		

        //get list of months
        $curr_date = new DateTime(date('Y-m-d'));
       	$date_founded = new DateTime(date($this->coop->date_founded));

       	$months = array();

       	if ($curr_date->format('Y') == $date_founded->format('Y')) {
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

		return view('member.contribution.monthly', compact('contributions', 'months', 'years', 'selected_year', 'selected_month'));
	}

	public function monthlyContributionYearSelected(Request $request)
	{
		return Redirect::route('member.contribution.monthly', ['y' => $request->year, 'm'=>$request->month]);
	}

	public function otherContribution()
	{
		return view('member.contribution.other');
	}

	public function loan()
	{
		$status_filter = Input::get('s');
		$statFilter = array();
		$cashLoan = "false";
		$loanable = "false";

		$stat = DB::table('loans')
		->select(DB::raw("DISTINCT status"))
		->where('user_id', '=', Auth::user()->id)
		// ->where('status', '=', 'pending')
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
		->where('user_id', '=', Auth::user()->id)
		->whereIn('status', $statFilter)
		->get();

		$user = User::where('status', 'active')->where('id', [Auth::user()->id])->first();

		$contribution = DB::table('contributions')
		->join('payments', 'contributions.payment_id', '=', 'payments.id')
		->select(DB::raw('FORMAT(SUM(contributions.amount), 2) AS amount'),
			DB::raw('SUM(contributions.amount) * 2 AS loan_limit')
		)
		->where('payments.payment', '=', 'Monthly Contribution')
		->where('contributions.user_id', '=', Auth::user()->id)
		->first();

		$interest = DB::table('interest')
		->where('type', '=', 'Member')
		->first();

		$activeLoan = DB::table('loans')
		->select(DB::raw('SUM(amount_loan) AS amount'), DB::raw('SUM(remaining_balance) AS balance'))
		->where('user_id', '=', Auth::user()->id)
		->where('status', '=', 'active')
		->first();

		if($activeLoan->balance >= $contribution->loan_limit){
			$cashLoan = "false";
		} else {
			$cashLoan = "true";
			$loanable = abs($contribution->loan_limit - $activeLoan->balance);
		}

		// dd($cashLoan);

		return view('member.loan.index', compact('loans', 'stat', 'status_filter', 'user', 'contribution', 'interest', 'cashLoan', 'activeLoan', 'loanable'));
	}

	public function loanFilter(Request $request)
	{
		// dd($request->filter);
		return Redirect::route('member.loan.index', ['s'=>$request->statusFilter]);
	}

	public function loanApply()
	{
		$user = User::where('status', 'active')->where('id', [Auth::user()->id])->first();
		$contribution = DB::table('contributions')
		->join('payments', 'contributions.payment_id', '=', 'payments.id')
		->select(DB::raw('FORMAT(SUM(contributions.amount), 2) AS amount'),
			DB::raw('SUM(contributions.amount) * 2 AS loan_limit')
		)
		->where('payments.payment', '=', 'Monthly Contribution')
		->where('contributions.user_id', '=', Auth::user()->id)
		->first();

		$interest = DB::table('interest')
		->where('type', '=', 'Member')
		->first();

		// dd($interest);

		return view('member.loan.create', compact('user', 'contribution', 'interest'));
	}

	public function storeLoan(Request $request)
	{

		if($request->confirm == 'no'){
			return Redirect::back();
		}else if($request->confirm == 'yes'){
			$loan = new Loan;

			$loan->user_id = Auth::user()->id;
			$loan->transaction_no = $request->transaction_no;
			$loan->status = "Pending";
			$loan->date_applied = date('Y-m-d H:i:s');
			$loan->amount_loan = $request->amount_loan;

	        $loan->save();

	        return Redirect::route('member.loan.index')->withFlashMessage('Loan successfully applied');
		}

		// dd($request->confirm);
		

		// $validator = Validator::make($data = Input::all(), Admin::$rules);
		// if ($validator->fails())
		// {
		// 	return Redirect::back()->withErrors($validator)->withInput();
		// }

		// dd($request->transaction_no);

		
	}

	public function report()
	{
		return view('member.report');
	}
}
