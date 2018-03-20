<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;
use DateTime;
use App\User;
use App\Cooperative;
use App\Officer;
use App\Admin;
use Carbon\Carbon;

class UserController extends Controller
{
    public function indexMember()
	{
		$selected_filter = Input::get('f');
		$members = '';
		
		if ($selected_filter != '') {
        	$members = User::where('role_id', '=', '3')
			->where('l_name', 'like', $selected_filter.'%')
			->orderBy('l_name', 'asc')
			->get();
        } else {
        	$members = User::where('role_id', '=', '3')
			->orderBy('l_name', 'asc')
			->get();
        }

		// dd($members);

		$coop = Cooperative::whereNotNull('id')->first();

		$filters = range('A', 'Z');

		// dd($alphas);

		return view('admin.members', compact('members', 'coop', 'filters', 'selected_filter'));
	}

	public function showMember($id)
	{
		$member = User::where('role_id', '=', '3')->where('id', '=', $id)->with('role')->first();
		$coop = Cooperative::whereNotNull('id')->first();

		//dd($member);
	
		return view('admin.show_users', compact('member', 'coop'));
	}

	public function editMember($id)
	{
		$member = User::where('role_id', '=', '3')->where('id', '=', $id)->with('role')->first();
		$coop = Cooperative::whereNotNull('id')->first();

		return view('admin.edit_users', compact('member', 'coop'));
	}

	public function updateMember(Request $request, $id)
	{

		$user = User::findOrFail($id);
		$coop = Cooperative::whereNotNull('id')->first();

		// $validator = Validator::make($request = Input::all(), User::$profile_rules);
		
		// if ($validator->fails())
		// 	{
		// 		return Redirect::back()->withErrors($validator)->withInput();
		// 	}
	
		$user->status = $request->status;
		
        $user->update();

        return Redirect::route('admin.member.show', ['member' => $id]); 
	}

	public function createMember()
	{
		$coop = Cooperative::whereNotNull('id')->first();
		// dd('test');
		//$coop = Cooperative::whereNotNull('id')->first();

		return view('admin.add_users', compact('coop'));
	}

	public function storeMember(Request $request)
	{
		// $validator = Validator::make($data = Input::all(), User::$rules);
		// if ($validator->fails())
		// {
		// 	return Redirect::back()->withErrors($validator)->withInput();
		// }

		// $cont = new User;
	}

	public function memberFilter(Request $request)
	{
		dd($request->filter);
		return Redirect::route('admin.member.index', ['f'=>$request->filter]);
	}

	public function indexOfficer()
	{
		
		$coop = Cooperative::whereNotNull('id')->first();

		$users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')
		->where('status', 'active')
		->whereNotIn('id', [DB::raw("SELECT DISTINCT user_id FROM officers WHERE status ='active'")])
		->orderBy('l_name')
		->pluck('fullName', 'id');

		$positions = DB::table('positions')
		->select('id', 'position')
		->whereNotIn('id', [DB::raw("SELECT DISTINCT position_id FROM officers JOIN positions ON positions.id =  officers.position_id WHERE status ='active' AND positions.type = 'individual'")])
		->orderBy('position')
		->pluck('position', 'id');

		$officers = DB::table('officers')
		->join('users', 'officers.user_id', '=', 'users.id')
		->join('positions', 'officers.position_id', '=', 'positions.id')
		->select('users.id', 'users.f_name', 'users.l_name', 'users.m_name', 'positions.position', 
			DB::raw("DATE_FORMAT(officers.from,'%Y %M') AS fromMoYr"),
			DB::raw("DATE_FORMAT(officers.to,'%Y %M') AS toMoYr"),
			DB::raw("(SELECT CONCAT(users.f_name, '', users.l_name) FROM users WHERE users.id = officers.added_by) AS add_by"),
			'officers.id', 'officers.status', 'officers.created_at')
		// ->where('users.role_id', '=', '2')
		->where('officers.status', '=', 'active')
		->get();

		// dd($officers);

		$inactive = DB::table('officers')
		->join('users', 'officers.user_id', '=', 'users.id')
		->join('positions', 'officers.position_id', '=', 'positions.id')
		->select('users.id', 'users.f_name', 'users.l_name', 'users.m_name', 'positions.position',
			DB::raw("DATE_FORMAT(officers.from,'%Y %M') AS fromMoYr"),
			DB::raw("DATE_FORMAT(officers.to,'%Y %M') AS toMoYr"),
			DB::raw("(SELECT CONCAT(users.f_name, '', users.l_name) FROM users WHERE users.id = officers.removed_by) AS rem_by"),
			'officers.updated_at', 'officers.remarks')
		->where('users.role_id', '=', '2')
		->where('officers.status', '=', 'inactive')
		->get();

		return view('admin.officer.index', compact('coop', 'officers', 'inactive', 'users', 'positions'));
	}

	public function storeOfficer(Request $request)
	{
		$validator = Validator::make($data = Input::all(), Officer::$rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$off = new Officer;
		$user = User::findOrFail($request->user_id);

		$off->user_id = $request->user_id;
		$off->position_id = $request->position_id;
		$off->status = "active";

		$dateFrom = DateTime::createFromFormat('M Y', $request->from);
        $off->from = $dateFrom->format('Y-m-d H:i:s');

        $dateTo = DateTime::createFromFormat('M Y', $request->to);
        $off->to = $dateTo->format('Y-m-d H:i:s');

        $off->added_by = Auth::user()->id;

        $off->save();

        $user->role_id = "2";
        $user->update();

        return Redirect::route('admin.officer.index')->withFlashMessage('Officer was added');
	}

	public function updateOfficer(Request $request)
	{
		$officer = Officer::findOrFail($request->officerId);
		$coop = Cooperative::whereNotNull('id')->first();

		$user_id = Officer::select('user_id')->where('id', '=', $request->officerId)->first();
		$admin = Admin::select('user_id')->where('user_id', '=', $user_id->user_id)->where('status', '=', 'active')->first();
		$user = User::findOrFail($user_id->user_id);
	
		$officer->status = "inactive";
		$officer->remarks = $request->remarks;
		$officer->to = date('Y-m-d H:i:s');
		$officer->removed_by = Auth::user()->id;
		
        $officer->update();

        if($admin){
			$user->role_id = "1";
		} else
			$user->role_id = "3";
			
        $user->update();

        return Redirect::route('admin.officer.index')->withFlashMessage('Officer was deactivated');
	}

	public function dateRange(Request $request)
	{
		return Redirect::route('admin.officer.index', ['f'=>$request->year, 't'=>$request->month]);
	}

	public function indexPending()
	{
		$paramType = Input::get('t');
		$selected_type = "";

		if ($paramType != '') {
        	$selected_type = $paramType;
        } else {
        	$selected_type = "pending";
        }

		$coop = Cooperative::whereNotNull('id')->first();

		$users = User::select(DB::raw("CONCAT(l_name, ' ', f_name) AS fullName"),
			'id', 'phone', 'address', 'b_date',
			'gender', 'civil_status', 'email', 'referral', 'ref_relation', 'created_at', 'status')
		->where('status', $selected_type)
		->orderBy('l_name')
		->get();

		// dd($users);

		return view('admin.pending.index', compact('coop', 'users', 'selected_type'));
	}

	public function indexPendingType(Request $request)
	{
		return Redirect::route('admin.pending.index', ['t'=>$request->type]);
	}

	public function confirmation()
	{
		$paramId = Crypt::decrypt(Input::get('u'));
		$user = User::findOrFail($paramId);
		$coop = Cooperative::whereNotNull('id')->first();

		//check if link is already expired (will expire after 7 days)
		if (Carbon::now()->greaterThan($user->reviewed_at->addDays(7))) {
	        return Redirect::route('login')->withFlashMessage('Sorry, the link has expired.');;
	    } else {
	    	$user->status = "active";
			$user->activated_at = date('Y-m-d H:i:s');
			
	        $user->update();

	        return Redirect::route('login')->withFlashMessage('Congratulations! Your account has been activated. You can now login using the email and password that you have registered.');
	    }
	}

	public function indexAdmin()
	{
		
		$coop = Cooperative::whereNotNull('id')->first();

		$users = User::select(DB::raw("CONCAT(l_name, ', ', f_name) AS fullName"),'id')
		->where('status', 'active')
		->whereNotIn('id', [DB::raw("SELECT DISTINCT user_id FROM admins WHERE status ='active'")])
		->orderBy('l_name')
		->pluck('fullName', 'id');

		$admins = DB::table('admins')
		->join('users', 'admins.user_id', '=', 'users.id')
		->select('users.id', 'users.f_name', 'users.l_name', 'users.m_name',
			DB::raw("DATE_FORMAT(admins.from,'%Y %M') AS fromMoYr"),
			DB::raw("DATE_FORMAT(admins.to,'%Y %M') AS toMoYr"),
			DB::raw("(SELECT CONCAT(users.f_name, '', users.l_name) FROM users WHERE users.id = admins.added_by) AS add_by"),
			'admins.id', 'admins.status', 'admins.created_at')
		// ->where('users.role_id', '=', '1')
		->where('admins.status', '=', 'active')
		->get();

		// dd($admins);

		$inactive = DB::table('admins')
		->join('users', 'admins.user_id', '=', 'users.id')
		->select('users.id', 'users.f_name', 'users.l_name', 'users.m_name',
			DB::raw("DATE_FORMAT(admins.from,'%Y %M') AS fromMoYr"),
			DB::raw("DATE_FORMAT(admins.to,'%Y %M') AS toMoYr"),
			DB::raw("(SELECT CONCAT(users.f_name, '', users.l_name) FROM users WHERE users.id = admins.removed_by) AS rem_by"),
			'admins.updated_at', 'admins.remarks')
		->where('users.role_id', '=', '2')
		->where('admins.status', '=', 'inactive')
		->get();

		return view('admin.admin.index', compact('coop', 'admins', 'inactive', 'users'));
	}

	public function storeAdmin(Request $request)
	{
		$validator = Validator::make($data = Input::all(), Admin::$rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ad = new Admin;

		$user = User::findOrFail($request->user_id);

		$ad->user_id = $request->user_id;
		$ad->status = "active";

		$dateFrom = DateTime::createFromFormat('M Y', $request->from);
        $ad->from = $dateFrom->format('Y-m-d H:i:s');

        $dateTo = DateTime::createFromFormat('M Y', $request->to);
        $ad->to = $dateTo->format('Y-m-d H:i:s');

        $ad->added_by = Auth::user()->id;

        $ad->save();

        $user->role_id = "1";
        $user->update();

        return Redirect::route('admin.admin.index')->withFlashMessage('Admin was added');
	}

	public function updateAdmin(Request $request)
	{
		$ad = Admin::findOrFail($request->adminId);

		$user_id = Admin::select('user_id')->where('id', '=', $request->adminId)->first();
		$officer = Officer::select('user_id')->where('user_id', '=', $user_id->user_id)->where('status', '=', 'active')->first();
		$user = User::findOrFail($user_id->user_id);
		
		$coop = Cooperative::whereNotNull('id')->first();
	
		$ad->status = "inactive";
		$ad->remarks = $request->remarks;
		$ad->to = date('Y-m-d H:i:s');
		$ad->removed_by = Auth::user()->id;

        $ad->update();

        if($officer){
			$user->role_id = "2";
		} else
			$user->role_id = "3";

        $user->update();

        return Redirect::route('admin.admin.index')->withFlashMessage('Admin was deactivated');
	}


}
