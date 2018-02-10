<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cooperative;

class HomeController extends Controller
{
    public function index()
	{
		$coop = Cooperative::whereNotNull('id')->first();
		return view('home.index', compact('coop'));
	}
}
