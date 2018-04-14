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
use Carbon\Carbon;
use Artisan;
use Log;
use Storage;
use DB;
use DateTime;
use Auth;


class AdminController extends BaseController
{
    public function index()
	{
		return view('admin.index');
	}

	public function backupDB()
	{
		$disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];

        // dd($disk);

        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

		return view('admin.database.backup', compact('backups'));
	}

	public function storeBackupDB(Request $request)
	{
	
		$now = Carbon::now()->format("Y-m-d-H-m-i").'-backup.sql';
	    
	    try {
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            return Redirect::route('admin.database.backup')->withFlashMessage('Database backup success');

        } catch (Exception $e) {
            return Redirect::route('admin.database.backup')->withFlashMessage($e->getMessage());
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
         ->select('id', 'name', 'description', 'businesses.status', 'capital', 'interest', 'date_started', 
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

    
}
