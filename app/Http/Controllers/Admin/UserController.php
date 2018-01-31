<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function showMember()
	{
		$members = User::where('role_id', '=', '3')->orderBy('name', 'asc')->get();

		// /dd($members);

		return view('admin.members', compact('members'));
	}
}
