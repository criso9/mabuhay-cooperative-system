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
		$checkCoop = Cooperative::whereNotNull('id')->first();

		$logoSrc = $request->logo_img;
		$iconSrc = $request->icon_img;


		$validator = Validator::make($request = Input::all(), Cooperative::$rules);
		$validator->after(function ($validator) use ($logoSrc, $iconSrc, $checkCoop) {
            if($checkCoop != null){
            	if($logoSrc == ''){
            		$validator->errors()->add('logo', 'Logo is required.');
            	}
            	if($iconSrc == ''){
            		$validator->errors()->add('icon', 'Icon is required.');
            	}
			}
     
        });

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		//add new data
		if ($checkCoop == null) {
			if(Input::hasFile('logo') && Input::hasFile('icon')){
				$logo = Input::file('logo');
				$logoName = 'logo-'.date('Ymd-His').'.'.$logo->getClientOriginalExtension();
				$logo->move('uploads/logo', $logoName);

				$icon = Input::file('icon');
				$iconName = 'icon-'.date('Ymd-His').'.'.$icon->getClientOriginalExtension();
				$icon->move('uploads/icon', $iconName);
				
				$coop = new Cooperative;

		        $coop->name = $request->name;
		        $coop->logo = 'logo/'.$logoName;
		        $coop->icon = 'icon/'.$iconName;

		        $coop->save();
			}
		//edit existing data
		} else {
			if(Input::hasFile('logo') && Input::hasFile('icon')){
				$logo = Input::file('logo');
				$logoName = 'logo-'.date('Ymd-His').'.'.$logo->getClientOriginalExtension();
				$logo->move('uploads/logo', $logoName);

				$icon = Input::file('icon');
				$iconName = 'icon-'.date('Ymd-His').'.'.$icon->getClientOriginalExtension();
				$icon->move('uploads/icon', $iconName);

				$coop = Cooperative::select('id')->where('id', '=', $checkCoop->id)->first();

				$coop->name = $request->name;
				$coop->logo = 'logo/'.$logoName;
		        $coop->icon = 'icon/'.$iconName;

        		$coop->update();
			}
			
		}

        return Redirect::route('admin.index'); 
	} 
}
