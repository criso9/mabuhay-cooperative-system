<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use View;
use App\Cooperative;

class BaseController extends Controller
{
	protected $position;

    public function __construct()
	{
		$this->middleware(function ($request, $next) {
	       
			$this->coop = Cooperative::whereNotNull('id')->first();

			if(Auth::user()){
				$this->position = DB::table('officers')
				->join('positions', 'officers.position_id', '=', 'positions.id')
				->select('positions.position')
				->where('officers.user_id', '=', Auth::user()->id)
				->where('officers.status', '=', 'active')
				->value('positions.position');
			}

			View::share('position', $this->position);
			View::share('coop', $this->coop);

	        return $next($request);
	    });
	}
}
