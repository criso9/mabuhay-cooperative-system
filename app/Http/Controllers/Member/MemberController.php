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
use Carbon\Carbon;
use App\Cooperative;
use App\User;
use App\MonthlyContribution;
use App\Loan;
use Inani\Larapoll\Poll;

class MemberController extends BaseController
{
    public function index()
	{
		$curr_date = new DateTime(date('Y-m-d'));
		$curr_date->format('Y');

		$contributions = DB::table('users')
		->join('contributions', 'users.id', '=', 'contributions.user_id')
		->join('payments', 'contributions.payment_id', '=', 'payments.id')
        ->select(DB::raw('SUM(contributions.amount) AS amount'),
        	DB::raw('monthname(contributions.date) AS month'))
       	->whereYear('contributions.date', '=', $curr_date)
       	->where('contributions.user_id', '=', Auth::user()->id)
       	->where('payments.payment', '=', 'Monthly Contribution')
       	->orderBy(DB::raw('month(contributions.date)'), 'asc')
       	->groupBy(DB::raw('monthname(contributions.date)'))
        ->get();

        $poll = DB::table('polls')
    	->select('id', 'question', 'isClosed')
    	->where('isClosed', '=', '0')
    	->get();

		return view('member.index', compact('contributions', 'poll'));
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
            ->join('payments', 'contributions.payment_id', '=', 'payments.id')
            ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id',
            	DB::raw('monthname(contributions.date) AS month'))
           	->whereYear('contributions.date', '=', $selected_year)
           	->where(DB::raw('monthname(contributions.date)'), '=', $selected_month)
           	->where('contributions.user_id', '=', Auth::user()->id)
           	->where('payments.payment', '=', 'Monthly Contribution')
            ->get();
        } else {
        	$selected_month = 'All';

        	$contributions = DB::table('users')
            ->join('contributions', 'users.id', '=', 'contributions.user_id')
            ->join('payments', 'contributions.payment_id', '=', 'payments.id')
            ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id',
            	DB::raw('monthname(contributions.date) AS month'))
           	->whereYear('contributions.date', '=', $selected_year)
           	->where('contributions.user_id', '=', Auth::user()->id)
           	->where('payments.payment', '=', 'Monthly Contribution')
            ->get();
        }

        $payment = DB::table('payments')
		->select('id')
		->where('payment', '=', 'Monthly Contribution')
		->first();
		
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


		return view('member.contribution.monthly', compact('contributions', 'months', 'years', 'selected_year', 'selected_month', 'payment'));
	}

	public function monthlyContributionYearSelected(Request $request)
	{
		if($request->_payment == '1'){
        	return Redirect::route('member.contribution.monthly', ['y' => $request->year, 'm' => $request->month]);
        } else if ($request->_payment == '2') {
        	return Redirect::route('member.contribution.damayan', ['y' => $request->year]);
        } else if ($request->_payment == '3') {
        	return Redirect::route('member.contribution.sharecapital', ['y' => $request->year]);
        }

	}

	public function damayanContribution()
	{
		$curr_year = new DateTime(date('Y-m-d'));
		$paramYear = Input::get('y');
		$selected_year = "";
		$contributions = "";

		if ($paramYear != '') {
        	$selected_year = $paramYear;
        } else {
        	$selected_year = $curr_year->format('Y');
        }

        $contributions = DB::table('users')
        ->join('contributions', 'users.id', '=', 'contributions.user_id')
        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id')
       	->whereYear('contributions.date', '=', $selected_year)
       	->where('contributions.user_id', '=', Auth::user()->id)
       	->where('payments.payment', '=', 'Damayan')
        ->get();

        $payment = DB::table('payments')
		->select('id')
		->where('payment', '=', 'Damayan')
		->first();

        //get list of months
        $curr_date = new DateTime(date('Y-m-d'));
       	$date_founded = new DateTime(date($this->coop->date_founded));

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


		return view('member.contribution.damayan', compact('contributions', 'years', 'selected_year', 'payment'));
	}

	public function sharecapitalContribution()
	{
		$curr_year = new DateTime(date('Y-m-d'));
		$paramYear = Input::get('y');
		$selected_year = "";
		$contributions = "";

		if ($paramYear != '') {
        	$selected_year = $paramYear;
        } else {
        	$selected_year = $curr_year->format('Y');
        }

        $contributions = DB::table('users')
        ->join('contributions', 'users.id', '=', 'contributions.user_id')
        ->join('payments', 'contributions.payment_id', '=', 'payments.id')
        ->select('users.id', 'users.f_name', 'users.l_name', 'contributions.date_paid', 'contributions.amount', 'contributions.payment_type', 'contributions.receipt_no', 'contributions.id')
       	->whereYear('contributions.date', '=', $selected_year)
       	->where('contributions.user_id', '=', Auth::user()->id)
       	->where('payments.payment', '=', 'Share Capital')
        ->get();

        $payment = DB::table('payments')
		->select('id')
		->where('payment', '=', 'Share Capital')
		->first();

        //get list of months
        $curr_date = new DateTime(date('Y-m-d'));
       	$date_founded = new DateTime(date($this->coop->date_founded));

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

		return view('member.contribution.sharecapital', compact('contributions', 'years', 'selected_year', 'payment'));
	}

	public function loan()
	{
		$status_filter = Input::get('s');
		$statFilter = array();
		$cashLoan = "false";
		$motorLoan = "false";
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
		->select('loans.user_id', 'loans.transaction_no', 'loans.date_applied', 'loans.status', 'loans.amount_loan', 'loans.amount_paid', 'loans.amount_repayable', 'loans.interest_amount_paid', 'loans.scapital_amount', 'loans.scapital_amount_paid', 'loans.remaining_balance', 'loans.due_date', 'loans.id', 'loans.interest_amount', 'loans.reviewed_at', 'loans.remarks', 'loans.loan_type',
			DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE loans.reviewed_by = users.id) AS reviewed_by")
		)
		->where('user_id', '=', Auth::user()->id)
		->whereIn('loans.status', $statFilter)
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
		->where('loan_type', 'Cash')
		->whereIn('status', ['Active', 'Pending'])
		->first();

		if($contribution->amount != null){
			if($activeLoan->balance >= $contribution->loan_limit){
				$cashLoan = "false";
			} else {
				$cashLoan = "true";
				$loanable = abs($contribution->loan_limit - $activeLoan->balance);
			}
		}else{
			$cashLoan = "false";
			$loanable = 0;
		}

		//motor loan check
		$motorcount = DB::table('loans')
		->select('id')
		->where('user_id', '=', Auth::user()->id)
		->where('loan_type', 'Motor')
		->whereIn('status', ['Pending', 'Active'])
		->count();

		if($motorcount > 0){
			$motorLoan = "false";
		} else {
			$motorLoan = "true";
		}

		return view('member.loan.index', compact('loans', 'stat', 'status_filter', 'user', 'contribution', 'interest', 'cashLoan', 'activeLoan', 'loanable', 'motorLoan'));
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
			$loan->amount_repayable = $request->i_tpay;
			$loan->remaining_balance = $request->i_tpay;
			$loan->interest_amount = $request->i_intpay;
			$loan->scapital_amount = $request->i_shpay;
			$loan->type = $request->_type;
			$loan->loan_type = "Cash";

			if($request->_type == "d"){
				$loan->interest_amount_paid = $request->i_intpay;
				$loan->scapital_amount_paid = $request->i_shpay;
			}

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

	public function loanCash()
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

		$activeLoan = DB::table('loans')
		->select(DB::raw('SUM(amount_loan) AS amount'), DB::raw('SUM(remaining_balance) AS balance'))
		->where('user_id', '=', Auth::user()->id)
		->where('loan_type', 'Cash')
		->whereIn('status', ['active', 'pending'])
		->first();

		$loanable = 0;

		if($contribution->amount != null){
			if($activeLoan->balance >= $contribution->loan_limit){
				$cashLoan = "false";
			} else {
				$cashLoan = "true";
				$loanable = abs($contribution->loan_limit - $activeLoan->balance);
			}
		}else{
			$cashLoan = "false";
			$loanable = 0;
		}

		return view('member.loan.cash', compact('user', 'contribution', 'interest', 'activeLoan', 'loanable'));
	}

	public function loanMotor()
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

		$activeLoan = DB::table('loans')
		->select(DB::raw('SUM(amount_loan) AS amount'), DB::raw('SUM(remaining_balance) AS balance'))
		->where('user_id', '=', Auth::user()->id)
		->where('loan_type', 'Motor')
		->whereIn('status', ['active', 'pending'])
		->first();

		return view('member.loan.motor', compact('user', 'contribution', 'interest', 'activeLoan'));
	}

	public function storeLoanMotor(Request $request)
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
			$loan->amount_repayable = $request->i_tpay;
			$loan->remaining_balance = $request->i_tpay;
			$loan->interest_amount = $request->i_intpay;
			$loan->scapital_amount = 0;
			$loan->type = "";
			$loan->loan_type = "Motor";

			$loan->save();

	        return Redirect::route('member.loan.index')->withFlashMessage('Loan successfully applied');
		}
	}

	public function report()
	{
		return view('member.report');
	}

	public function votePoll(Poll $poll, Request $request)
    {
        try{
            $vote = $request->user()
                ->poll($poll)
                ->vote($request->get('options'));
            if($vote){
                return Redirect::route('member.index')->withFlashMessage('Done on Voting');
            }
        }catch (\Exception $e){
            return back()->with('errors', $e->getMessage());
        }
    }

    public function profileEdit(){
    	$user = DB::table('users')
		->select('id', 'f_name', 'm_name', 'l_name', 'phone', 'address', 'b_date', 'gender', 'civil_status','email', 'avatar')
		->where('id', '=', Auth::user()->id)
		->first();

		$gender = ['Male', 'Female'];
		$civilstat = ['Single', 'Married', 'Separated', 'Widowed'];

    	return view('member.profile.edit', compact('user', 'gender', 'civilstat'));
    }

    public function profileUpdate(Request $request){
    	$dt = Carbon::parse($request['b_date']);
        $age = Carbon::createFromDate($dt->year, $dt->month, $dt->day)->age;

    	$validator = Validator::make($request = Input::all(), User::$profile);

        $email = User::select('id')
        ->where('email', '=', $request['email'])
        ->whereNotIn('id', [Auth::user()->id])
        ->count();

        $fullName = User::select('id')
        ->where('f_name', '=', $request['f_name'])
        ->where('l_name', '=', $request['l_name'])
        ->where('m_name', '=', $request['m_name'])
        ->whereNotIn('id', [Auth::user()->id])
        ->count();

        $avatarReq = "";
        if($request['avatar_req']){
        	$avatarReq = $request['avatar'];
        }

        //Add custom validation
        $validator->after(function ($validator) use ($age, $email, $fullName, $avatarReq) {
            if($age < 18){
                $validator->errors()->add('b_date', 'You must 18 or over to be a member in this Cooperative');
            }
            if($email > 0){
                $validator->errors()->add('email', 'Email is already registered.');
            }
            if($fullName > 0){
                $validator->errors()->add('f_name', 'Name is already registered (Last, First and Middle Name).');
            }
            if($avatarReq != ''){
    			if($_FILES['avatar']['type'] != 'image/png' && $_FILES['avatar']['type'] != 'image/jpeg' && $_FILES['avatar']['type'] != 'image/jpg'){
    				
    				$validator->errors()->add('avatar', 'Profile image must be an image and must be a file of type: jpg, png');
    			}
    			if($_FILES['avatar']['size'] > '8000000'){
    				
    				$validator->errors()->add('avatar', 'Profile image size must be less than or equal to 8MB');
    			}
	    	}
        });

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    	$user = User::findOrFail(Auth::user()->id);

        $user->f_name = $request['f_name']; 
        $user->l_name = $request['l_name']; 
        $user->m_name = $request['m_name']; 
        $user->phone = $request['phone'];   
        $user->address = $request['address'];  

        $bDate = DateTime::createFromFormat('M d, Y', $request['b_date']);
        $user->b_date = $bDate->format('Y-m-d');
  
        $user->gender = $request['gender'];  
        $user->civil_status = $request['civil_status'];
        $user->email = $request['email']; 

        if($avatarReq != ''){
        	$tmpFilePath = $_FILES['avatar']['tmp_name'];
	    	$fileName = "pic-".date('Ymd-His').'-'.$_FILES['avatar']['name'];
		    $filePath = "uploads/profile/pic-".date('Ymd-His').'-'.$_FILES['avatar']['name'];

		   	move_uploaded_file($tmpFilePath, $filePath);

		   	$user->avatar = $fileName;
        }

        $user->update();

        return Redirect::route('member.index')->withStatusMessage('Profile was updated');
    }

    public function passwordEdit(){
    	$user = DB::table('users')
		->select('id', 'email', 'password')
		->where('id', '=', Auth::user()->id)
		->first();

    	return view('member.password.edit', compact('user'));
    }

    public function passwordUpdate(Request $request){
    	$validator = Validator::make($request = Input::all(), User::$password);

    	$user = DB::table('users')
		->select('id', 'email', 'password')
		->where('id', '=', Auth::user()->id)
		->first();

    	$curPassword = $request['current_password'];
    	$newPassword = $request['password'];

    	//Add custom validation
        $validator->after(function ($validator) use ($curPassword, $newPassword, $user) {
            if(!Auth::attempt(array('password' => Input::get('current_password')))){
                $validator->errors()->add('current_password', 'Current password does not match.');
            }
            if(Input::get('current_password') == $newPassword){
                $validator->errors()->add('password', 'New password should be different from the current.');
            }
        });

    	if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    	$userChange = User::findOrFail(Auth::user()->id);

        $userChange->password = bcrypt($request['password']);
       
        $userChange->update();

    	return Redirect::route('member.index')->withStatusMessage('Password was change');
    }
}
