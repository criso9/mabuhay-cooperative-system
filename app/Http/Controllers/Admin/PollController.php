<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Inani\Larapoll\Helpers\PollHandler;
use Inani\Larapoll\Http\Request\PollCreationRequest;
use App\Poll;
use App\Cooperative;
use Auth;
use DB;
use View;

class PollController extends Controller
{
	/**
     *  Constructor
     *
     */
    public function __construct()
    {
        $this->middleware( config('larapoll_config.admin_auth') );

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

    public function index()
    {
        $polls = Poll::withCount('options', 'votes')->latest();

        return view('admin.poll.index', compact('polls'));
    }

    public function create()
    {
        return view('admin.poll.create');
    }

    public function store(Request $request)
    {
    	$poll = PollHandler::createFromRequest($request->all());

       // $poll = new Poll([
       //      'question' => $request['question']
       //  ]);

       
       //  $poll->addOptions($request['options']);

       //  $poll->generate();

        return redirect(route('admin.poll.index'))
            ->with('success', 'Your poll has been addedd successfully');
    }
}
