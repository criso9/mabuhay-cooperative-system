<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Cooperative;

class CoopController extends BaseController
{
    public function index()
	{
		
		return view('admin.settings.coop');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($data = Input::all(), Cooperative::$rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$checkCoop = Cooperative::whereNotNull('id')->first();

		//add new data
		if ($checkCoop == null) {
			if(Input::hasFile('logo') && Input::hasFile('banner')){
				$logo = Input::file('logo');
				$logoName = 'logo-'.date('Ymd-His').'.'.$logo->getClientOriginalExtension();
				$logo->move('uploads/logo', $logoName);

				$banner = Input::file('banner');
				$bannerName = 'banner-'.date('Ymd-His').'.'.$banner->getClientOriginalExtension();
				$banner->move('uploads/banner', $bannerName);
				
				$coop = new Cooperative;

		        $coop->name = $request->name;
		        $coop->logo = 'logo/'.$logoName;
		        $coop->banner = 'banner/'.$bannerName;

		        $coop->save();
			}
		//edit existing data
		} else {
			if(Input::hasFile('logo') && Input::hasFile('banner')){
				$logo = Input::file('logo');
				$logoName = 'logo-'.date('Ymd-His').'.'.$logo->getClientOriginalExtension();
				$logo->move('uploads/logo', $logoName);

				$banner = Input::file('banner');
				$bannerName = 'banner-'.date('Ymd-His').'.'.$banner->getClientOriginalExtension();
				$banner->move('uploads/banner', $bannerName);

				$coop = Cooperative::select('id')->where('id', '=', $checkCoop->id)->first();

				$coop->name = $request->name;
				$coop->logo = 'logo/'.$logoName;
		        $coop->banner = 'banner/'.$bannerName;

        		$coop->update();
			}
			
		}

        return Redirect::route('admin.index'); 
	} 
}
