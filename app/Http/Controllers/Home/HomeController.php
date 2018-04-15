<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Cooperative;
use DB;

class HomeController extends BaseController
{
    public function index()
	{
		$carousel = DB::table('images_uploaded')
		 ->join('images_type', 'images_uploaded.type_id', '=', 'images_type.id')
         ->select('images_uploaded.id', 'path', 'url')
         ->where('images_type.type', 'carousel')
         ->where('images_uploaded.status', 'active')
         ->get();

		return view('home.index', compact('carousel'));
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
