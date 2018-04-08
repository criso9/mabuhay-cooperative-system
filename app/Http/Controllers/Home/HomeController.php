<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Cooperative;

class HomeController extends BaseController
{
    public function index()
	{
		return view('home.index');
	}

	public function about()
	{
		return view('home.about');
	}

	public function services()
	{
		return view('home.services');
	}

	public function contacts()
	{
		return view('home.contacts');
	}

	public function forbidden()
	{
		return view('layout.403');
	}


}
