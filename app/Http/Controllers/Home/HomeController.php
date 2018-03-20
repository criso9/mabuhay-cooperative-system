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

	public function about()
	{
		$coop = Cooperative::whereNotNull('id')->first();
		return view('home.about', compact('coop'));
	}

	public function services()
	{
		$coop = Cooperative::whereNotNull('id')->first();
		return view('home.services', compact('coop'));
	}

	public function contacts()
	{
		$coop = Cooperative::whereNotNull('id')->first();
		return view('home.contacts', compact('coop'));
	}

	public function forbidden()
	{
		$coop = Cooperative::whereNotNull('id')->first();
		return view('layout.403', compact('coop'));
	}


}
