<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Cooperative;
use Carbon\Carbon;
use Artisan;
use Log;
use Storage;


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

    
}
