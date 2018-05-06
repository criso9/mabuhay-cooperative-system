<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Cooperative;
use App\ImagesUploaded;
use App\FilesUploaded;
use DateTime;
use DB;
use Auth;

class CoopController extends BaseController
{
    public function index()
	{
		$carousel = DB::table('images_uploaded')
		 ->join('images_type', 'images_uploaded.type_id', '=', 'images_type.id')
         ->select('images_uploaded.id', 'path', 'url', 'added_at', 'removed_at', 'remarks',
         	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE images_uploaded.added_by = users.id) AS added_by"),
         	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE images_uploaded.removed_by = users.id) AS removed_by")
     		)
         ->where('images_type.type', 'carousel')
         ->where('images_uploaded.status', 'active')
         ->get();

        $document = DB::table('files_uploaded')
		 ->join('files_type', 'files_uploaded.type_id', '=', 'files_type.id')
         ->select('files_uploaded.id', 'files_type.type', 'path', 'orig_file_name', 'file_name', 'added_at', 'removed_at', 'remarks',
         	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE files_uploaded.added_by = users.id) AS added_by"),
         	DB::raw("(SELECT CONCAT(users.f_name, ' ', users.l_name) FROM users WHERE files_uploaded.removed_by = users.id) AS removed_by")
     		)
         ->whereIn('files_type.type', ['policies', 'others'])
         ->where('files_uploaded.status', 'active')
         ->get();

		$fileType = DB::table('files_type')
		->select('type', 'id')
		->whereIn('files_type.type', ['policies', 'others'])
		->orderBy('type')
		->pluck('type', 'id');
		
		return view('admin.settings.coop', compact('carousel', 'fileType', 'document'));
	}

	public function store(Request $request)
	{

		$checkCoop = Cooperative::whereNotNull('id')->first();

		$logoSrc = $request['logo_img'];
		$iconSrc = $request['icon_img'];

		$logoReq = $request['logo'];
		$iconReq = $request['icon'];

		$fileReq = $request['docs'];

		$validator = Validator::make($request = Input::all(), Cooperative::$rules);

		$validator->after(function ($validator) use ($logoSrc, $iconSrc, $checkCoop, $logoReq, $iconReq) {
            if(count($checkCoop) > 0){
            	if($logoSrc == '' && $logoReq == ''){
            		$validator->errors()->add('logo', 'Logo is required.');
            	}
            	if($iconSrc == '' && $iconReq == ''){
            		$validator->errors()->add('icon', 'Icon is required.');
            	}
			}
     
        });

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		//add new data
		if (count($checkCoop) < 1) {
			// if(Input::hasFile('logo') && Input::hasFile('icon')){
			// 	$logo = Input::file('logo');
			// 	$logoName = 'logo-'.date('Ymd-His').'.'.$logo->getClientOriginalExtension();
			// 	$logo->move('uploads/logo', $logoName);

			// 	$icon = Input::file('icon');
			// 	$iconName = 'icon-'.date('Ymd-His').'.'.$icon->getClientOriginalExtension();
			// 	$icon->move('uploads/icon', $iconName);
				
			// 	$coop = new Cooperative;

		 //        $coop->name = $request['coop_name'];
		        
		 //        $dateFounded = DateTime::createFromFormat('M d, Y', $request['date_founded']);
   //      		$coop->date_founded = $dateFounded->format('Y-m-d');

		 //        $coop->mission = $request['mission'];
		 //        $coop->vision = $request['vision'];
		 //        $coop->logo = 'logo/'.$logoName;
		 //        $coop->icon = 'icon/'.$iconName;

		 //        $coop->save();
			// }
		//edit existing data
		} else if (count($checkCoop) > 0) {

			$logoName = "";
			$iconName = "";
			$carouselName = "";

			$coop = Cooperative::findOrFail($checkCoop->id);

			$coop->coop_name = $request['coop_name'];

			$dateFounded = DateTime::createFromFormat('M d, Y', $request['date_founded']);
        	$coop->date_founded = $dateFounded->format('Y-m-d');

			$coop->mission = $request['mission'];
		    $coop->vision = $request['vision'];
			$coop->mem_int = $request['mem_int'];
			$coop->nonmem_int = $request['nonmem_int'];

		    if(Input::hasFile('logo')){
				$logo = Input::file('logo');
				$logoName = 'logo-'.date('Ymd-His').'.'.$logo->getClientOriginalExtension();
				$logo->move('uploads/logo', $logoName);
				$coop->logo = 'logo/'.$logoName;
			}

			if(Input::hasFile('icon')){
				$icon = Input::file('icon');
				$iconName = 'icon-'.date('Ymd-His').'.'.$icon->getClientOriginalExtension();
				$icon->move('uploads/icon', $iconName);
				$coop->icon = 'icon/'.$iconName;
			}

			
			$coop->update();
		}

        return Redirect::route('admin.coop')->withFlashMessage('Changes save successfully'); 
	} 

	public function addImage(Request $request){
		
		$carouselReq = $request['carousel_img'];

		$validator = Validator::make($request = Input::all(), Cooperative::$carousel_rules);

		$validator->after(function ($validator) use ($carouselReq) {
	    	if($carouselReq == ''){
	    		$validator->errors()->add('carousel_img', 'Carousel Image is required.');
	    	}else{
	    		for($i=0; $i<count($_FILES['carousel_img']['name']); $i++) {
	    			if($_FILES['carousel_img']['type'][$i] != 'image/png' && $_FILES['carousel_img']['type'][$i] != 'image/jpeg' && $_FILES['carousel_img']['type'][$i] != 'image/jpg'){
	    				
	    				$validator->errors()->add('carousel_img', 'Carousel must be an image and must be a file of type: jpg, png');
	    			}
	    			if($_FILES['carousel_img']['size'][$i] > '8000000'){
	    				
	    				$validator->errors()->add('carousel_img', 'Carousel image size must be less than or equal to 8MB');
	    			}
	    		}
	    	}
     
        });

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		if(count($_FILES['carousel_img']['name']) > 0){

			for($i=0; $i<count($_FILES['carousel_img']['name']); $i++) {
				$tmpFilePath = $_FILES['carousel_img']['tmp_name'][$i];
			    $filePath = "uploads/carousel/carousel-".date('Ymd-His').'-'.$_FILES['carousel_img']['name'][$i];

			   	move_uploaded_file($tmpFilePath, $filePath);

			   	$imgUpload = new ImagesUploaded;
			    
			    $imgUpload->type_id = 1;
			    $imgUpload->status = 'active';
			    $imgUpload->path = $filePath;
			    $imgUpload->url = $request['url'];
			    $imgUpload->added_by = Auth::user()->id;
			    $imgUpload->added_at = date('Y-m-d H:i:s');

			    $imgUpload->save();
			}
		}

        return Redirect::route('admin.coop')->withFlashMessage('Changes save successfully');
	}

	public function addFile(Request $request){
		$fileReq = $request['docs'];

		$validator = Validator::make($request = Input::all(), Cooperative::$docs_rules);

		$validator->after(function ($validator) use ($fileReq) {
	    	if($fileReq == ''){
	    		$validator->errors()->add('docs', 'File is required.');
	    	}else{
	    		for($i=0; $i<count($_FILES['docs']['name']); $i++) {
	    			if($_FILES['docs']['type'][$i] != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && $_FILES['docs']['type'][$i] != 'application/pdf' && $_FILES['docs']['type'][$i] != 'application/msword'){
	    				$validator->errors()->add('docs', 'Document must be a file of type: docx, pdf');
	    			}
	    		}
	    	}
     
        });

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		if(count($_FILES['docs']['name']) > 0){

			for($i=0; $i<count($_FILES['docs']['name']); $i++) {
				$tmpFilePath = $_FILES['docs']['tmp_name'][$i];
				$fileName = $request['file_type']."-".date('Ymd-His').'-'.$_FILES['docs']['name'][$i];
			    $filePath = "uploads/documents/".$fileName;

			    $origFileName = $_FILES['docs']['name'][$i];

			   	move_uploaded_file($tmpFilePath, $filePath);

			   	$fileUpload = new FilesUploaded;
			    
			    $fileUpload->type_id = $request['file_type'];
			    $fileUpload->status = 'active';
			    $fileUpload->orig_file_name = $origFileName;
			    $fileUpload->file_name = $fileName;
			    $fileUpload->path = $filePath;
			    $fileUpload->added_by = Auth::user()->id;
			    $fileUpload->added_at = date('Y-m-d H:i:s');

			    $fileUpload->save();
			}
		}

        return Redirect::route('admin.coop')->withFlashMessage('Changes save successfully');
	}

	public function deleteImage(Request $request){
		$imagesUploaded = ImagesUploaded::findOrFail($request->_id);

		$imagesUploaded->status = 'inactive';
		$imagesUploaded->removed_by = Auth::user()->id;
		$imagesUploaded->removed_at = date('Y-m-d H:i:s');
		$imagesUploaded->remarks = $request->remarks;

		$imagesUploaded->update();

		return Redirect::route('admin.coop')->withFlashMessage('Changes save successfully'); 
	}

	public function deleteFile(Request $request){
		$fileUploaded = FilesUploaded::findOrFail($request->_fileId);

		$fileUploaded->status = 'inactive';
		$fileUploaded->removed_by = Auth::user()->id;
		$fileUploaded->removed_at = date('Y-m-d H:i:s');
		$fileUploaded->remarks = $request->remarks_file;

		$fileUploaded->update();

		return Redirect::route('admin.coop')->withFlashMessage('Changes save successfully'); 
	}
}
