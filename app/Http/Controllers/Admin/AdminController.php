<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Cooperative;

class AdminController extends Controller
{
    public function index()
	{
		$coop = Cooperative::whereNotNull('id')->first();

		//dd($coop);

		return view('admin.index', compact('coop'));
	}
}
