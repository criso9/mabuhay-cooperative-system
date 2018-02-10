<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Cooperative;

class UserController extends Controller
{
    public function indexMember()
	{
		$members = User::where('role_id', '=', '3')->orderBy('f_name', 'asc')->get();
		$coop = Cooperative::whereNotNull('id')->first();

		//dd($coop);

		return view('admin.members', compact('members', 'coop'));
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

		return view('admin.add_users', compact('coop'));
	}
}
