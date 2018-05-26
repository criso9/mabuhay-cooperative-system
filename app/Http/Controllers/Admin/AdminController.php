<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Cooperative;
use App\Business;
use App\BusinessIncome;
use Carbon\Carbon;
use Artisan;
use Log;
use Storage;
use DB;
use DateTime;
use Auth;
use Inani\Larapoll\Poll;
use App\Http\Requests\PollCreationRequest;
use App\Http\Requests\AddOptionsRequest;
use Inani\Larapoll\Helpers\PollHandler;

class AdminController extends BaseController
{
    public function index()
	{

        $users = DB::table('users')
        ->select('id')
        ->count();

        $active = DB::table('users')
        ->select('id')
        ->where('status', 'active')
        ->count();

        $inactive = DB::table('users')
        ->select('id')
        ->where('status', 'inactive')
        ->count();

        $pending = DB::table('users')
        ->select('id')
        ->where('status', 'pending')
        ->count();

        $waiting = DB::table('users')
        ->select('id')
        ->where('status', 'waiting')
        ->count();

        $rejected = DB::table('users')
        ->select('id')
        ->where('status', 'rejected')
        ->count();

        // dd($users);

		return view('admin.index', compact('users', 'active', 'inactive', 'rejected', 'pending', 'waiting'));
	}

	public function indexBackup()
	{
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];

        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                
                // $size = $disk->size($f);
                // $fileSize = "";
                
                // if( ($size >= 1<<30))
                //     $fileSize = number_format($size/(1<<30),2)." GB";
                // if( ($size >= 1<<20))
                //     $fileSize = number_format($size/(1<<20),2)." MB";
                // if( ($size >= 1<<10))
                //     $fileSize = number_format($size/(1<<10),2)." KB";
                // else
                //     $fileSize = number_format($size)." bytes";
  
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $this->human_filesize($disk->size($f)),
                    'last_modified' => $this->get_date($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view('admin.backup.index', compact('backups'));
	}
	
	function get_date($date_modify)
	{
	    return Carbon::createFromTimeStamp($date_modify)->formatLocalized('%B %d, %Y %H:%M');
	}
	
	function human_filesize($bytes, $decimals = 2)
	{
	    if($bytes < 1024){
	        return $bytes . ' B';
	    }
	    
	    $factor = floor(log($bytes, 1024));
	    
	    return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . ['B', 'KB', 'MB', 'GB', 'TB', 'PB'][$factor];
	}

    public function createBackupDb()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', [
                '--only-db' => 'true'
            ]);
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            return Redirect::route('admin.backup.index')->withFlashMessage('Database backup success');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function createBackupApp()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', [
                '--only-files' => 'true'
            ]);
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            return Redirect::route('admin.backup.index')->withFlashMessage('Database backup success');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function downloadBackup($file_name)
    {
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function deleteBackup($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return Redirect::route('admin.backup.index')->withFlashMessage('Backup was deleted');
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function businessList()
    {
        $status_filter = Input::get('s');
        $statFilter = array();

        $stat = DB::table('businesses')
        ->select(DB::raw("DISTINCT status"))
        ->pluck('status');

        if($status_filter == 'all' || $status_filter == ''){
            foreach($stat as $s) {
                array_push($statFilter, $s);
            }
        }else{
            array_push($statFilter,  $status_filter);
        }

        $business = DB::table('businesses')
         ->select('id', 'name', 'description', 'businesses.status', 'capital', 'income', 'profit', 'date_started', 
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE businesses.added_by = users.id) AS added_by"),
            'date_ended',
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE businesses.removed_by = users.id) AS removed_by"),
            'remarks'
        )
        ->whereIn('status', $statFilter)
        -> get();

        return view('admin.business.index', compact('business', 'stat', 'status_filter'));
    }


    public function businessFilter(Request $request)
    {
        return Redirect::route('admin.business.index', ['s'=>$request->statusFilter]);
    }

    public function businessAdd(Request $request)
    {
        $business = new Business;

        $business->name = $request->name;
        $business->description = $request->description;
        $business->status = "Active";
        $business->capital = $request->capital;

        $dateStarted = DateTime::createFromFormat('M d, Y', $request->date_started);
        $business->date_started = $dateStarted->format('Y-m-d');
        
        $business->added_by = Auth::user()->id;

        $business->save();

        return Redirect::route('admin.business.index')->withFlashMessage('Business was added');
    }

    public function businessUpdate(Request $request)
    {
        $business = Business::findOrFail($request->_id);

        $business->status = "Inactive";
        $business->date_ended = date('Y-m-d');
        $business->removed_by = Auth::user()->id;
        $business->remarks = $request->remarks;        

        $business->update();

        return Redirect::route('admin.business.index')->withFlashMessage('Business was deactivated');
    }

    public function viewBusiness($id)
    {
        $business = DB::table('business_incomes')
        ->join('businesses', 'business_incomes.business_id', '=', 'businesses.id')
        ->select('business_incomes.id', 'business_id', 'businesses.name', 'businesses.description', 'business_incomes.amount', 'business_incomes.date_paid',
            DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE business_incomes.updated_by = users.id) AS updated_by")
        )
        ->where('business_incomes.business_id', '=', $id)
        ->where('businesses.status', '=', 'Active')
        ->get();

        $businessName = DB::table('businesses')
        ->select('id','name', 'description')
        ->where('id', '=', $id)
        ->where('status', '=', 'Active')
        ->first();

        return view('admin.business.show', compact('business', 'businessName'));
    }

    public function addBusinessIncome(Request $request, $id)
    {

        $businessIncome = new BusinessIncome;

        $businessIncome->business_id = $id; 
        $businessIncome->amount = $request->amount;

        $datePaid = DateTime::createFromFormat('M d, Y', $request->date_paid);
        $businessIncome->date_paid = $datePaid->format('Y-m-d');

        $businessIncome->updated_by = Auth::user()->id;

        $businessIncome->save();


        $business = Business::findOrFail($id);

        $busIncome = $business->income + $request->amount;

        $business->income = $business->income + $request->amount;

        if($busIncome > $business->capital){
            $busProfit = $busIncome - $business->capital;
            $business->profit = $busProfit;
        }

        $business->update();

        return Redirect('/admin/business/'.$id)->withFlashMessage('Business Income was added');
    }

    public function indexPoll()
    {

        $polls = Poll::withCount('options', 'votes')->latest()->paginate(
            config('larapoll_config.pagination')
        );

        return view('admin.poll.index', compact('polls'));
    }

    public function removePoll(Poll $poll)
    {
        $poll->remove();

        return redirect(route('admin.poll.index'))
            ->with('success', 'Your poll has been deleted successfully');
    }

    public function createPoll()
    {
        return view('admin.poll.create');
    }

    public function lockPoll(Poll $poll)
    {
        $poll->lock();
        return redirect(route('admin.poll.index'))
            ->with('success', 'Your poll has been locked successfully');
    }

    public function unlockPoll(Poll $poll)
    {
        $poll->unLock();
        return redirect(route('admin.poll.index'))
            ->with('success', 'Your poll has been unlocked successfully');
    }

    public function editPoll(Poll $poll)
    {
        return view('admin.poll.edit', compact('poll'));
    }

    public function updatePoll(Poll $poll, Request $request)
    {
        PollHandler::modify($poll, $request->all());

        return redirect(route('admin.poll.index'))
            ->with('success', 'Your poll has been updated successfully');
    }

    public function storePoll(PollCreationRequest $request)
    {
        $poll = PollHandler::createFromRequest($request->all());
        return redirect(route('admin.poll.index'))
            ->with('success', 'Your poll has been addedd successfully');
    }

    public function pushPoll(Poll $poll)
    {
        return view('admin.poll.options.push', compact('poll'));
    }

    public function addPollOptions(Poll $poll, AddOptionsRequest $request)
    {
        $poll->attach($request->get('options'));

        return redirect(route('admin.poll.index'))
            ->with('success', 'New poll options have been added successfully');
    }

     public function deletePollOptions(Poll $poll)
    {
        return view('admin.poll.options.remove', compact('poll'));
    }

    public function removePollOptions(Poll $poll, Request $request)
    {
        try{
            $poll->detach($request->get('options'));
            return redirect(route('admin.poll.index'))
                ->with('success', 'Poll options have been removed successfully');
        }catch (\Exception $e){
            $message = PollHandler::getMessage($e);

            return back()
                ->withErrors($message);
        }
    }

    public function votePoll(Poll $poll, Request $request)
    {
        try{
            $vote = $request->user()
                ->poll($poll)
                ->vote($request->get('options'));
            if($vote){
                return Redirect::route('officer.index')->withStatusMessage('Done on voting');
            }
        }catch (\Exception $e){
            return back()->with('errors', $e->getMessage());
        }
    }
    

}
