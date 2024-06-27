<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			FileUpload.php
* @brief		This file contains the implementation of the FileUpload
* @path			\app\Helpers
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers;

use App\Models\Tenant\Admin\Attachment;
use App\Models\Tenant\Manage\Entity;
use App\Models\User;

use File;
// use Illuminate\Support\Facades\File;
use Image;

use Request;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUpload
{

	public static function aws(FormRequest $request)
	{
		$request->validate(['file_to_upload'	=> 'required|file|mimes:eml,msg,zip,rar,doc,docx,xls,xlsx,pdf,jpg,png|max:2048']);
		
		// ===> both file_to_upload and fileName is used
		if ($request->hasFile('file_to_upload')) {
			$file 			= $request->file('file_to_upload');
		} else {
			Log::error('Helpers.FileUpload.aws No file found!');
			$attachment_id = 0;
			return $attachment_id;
		}

		if (! $file->isValid()) {
			Log::error('Helpers.FileUpload.aws file is invalid.');
			$attachment_id = 0;
			return $attachment_id;
		}

		$fileName 		= $request->article_id.'-'. uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		// get tenant, entity and rectory to upload
		$entity 		= Entity::where('entity', $request->entity)->first();
		$fileUploadPath = tenant('id')."/".$entity->directory."/". $fileName;
		Log::debug('Helpers.FileUpload.aws Value of fileUploadPath = '. $fileUploadPath);

		try {
			//Code that may throw an Exception
			//$request->file_to_upload->storeAs('private/'.$directory.'/', $fileName);

			$path= Storage::disk('s3tf')->put($fileUploadPath, file_get_contents($file));
			//Log::debug('Helpers.FileUpload.aws Value of path = '. $path);

			// create Attachment record 
			$attachment					= new Attachment();
			$attachment->article_id		= $request->article_id;
			$attachment->entity			= $request->entity;
			$attachment->file_entity	= ($request->has('file_entity')) ? $request->file_entity : $request->entity;

			$attachment->owner_id		= auth()->check() ? auth()->user()->id : config('akk.GUEST_USER_ID');

			$attachment->summary		= ($request->has('summary')) ? $request->summary : 'No details';
			$attachment->file_name		= $fileName;
			$attachment->org_file_name	= $org_fileName;
			$attachment->file_type		= $request->file('file_to_upload')->getMimeType();
			$attachment->file_size		= $request->file('file_to_upload')->getSize();
			$attachment->upload_date	= now(); //date('Y-m-d H:i:s');

			$attachment->save();
			$attachment_id				=$attachment->id;
		} catch (Exception $e) {
			// Log the message locally OR use a tool like Bugsnag/Flare to log the error
			Log::error('Helpers.FileUpload.aws '.$e->getMessage());
			// Either form a friendlier message to display to the user OR redirect them to a failure page
			$attachment_id = 0;
		}
	
		return $attachment_id;
	}

	public static function upload(FormRequest $request)
	{

		// ===> both file_to_upload and fileName is used

		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		// get entity and directory to upload
		$entity 		= Entity::where('entity', $request->entity)->first();
		$directory 		= $entity->directory;

		// OK. Store File in Storage Private Folder. Auto create folder
		// $request->file_to_upload->storeAs('private/pr/', $fileName);
		// D:\laravel\po02\storage\tenantgeda\app\private\pr

		try {
			//Code that may throw an Exception
			$request->file_to_upload->storeAs('private/'.$directory.'/', $fileName);

			// create Attachment record 
			$attachment					= new Attachment();
			$attachment->article_id		= $request->article_id;
			$attachment->entity			= $request->entity;
			$attachment->file_entity	= ($request->has('file_entity')) ? $request->file_entity : $request->entity;

			$attachment->owner_id		= auth()->check() ? auth()->user()->id : config('akk.GUEST_USER_ID');

			$attachment->summary		= ($request->has('summary')) ? $request->summary : 'No details';
			$attachment->file_name		= $fileName;
			$attachment->org_file_name	= $org_fileName;
			$attachment->file_type		= $request->file('file_to_upload')->getMimeType();
			$attachment->file_size		= $request->file('file_to_upload')->getSize();
			$attachment->upload_date	= now(); //date('Y-m-d H:i:s');

			$attachment->save();
			$attachment_id				=$attachment->id;
		} catch (Exception $e) {
			// Log the message locally OR use a tool like Bugsnag/Flare to log the error
			Log::error('Helpers.FileUpload.upload '.$e->getMessage());
			// Either form a friendlier message to display to the user OR redirect them to a failure page
			$attachment_id = 0;
		}
	
		return $attachment_id;
	}

	public static function uploadPublicPhoto(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();


		// get entity and directory
		$directory 		= 'profile';

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->move(public_path('landlord/'.$directory), $fileName);

		} catch (Exception $e) {

			$message = $e->getMessage();
			var_dump('Exception Message: '. $message);

			$code = $e->getCode();
			var_dump('Exception Code: '. $code);

			$string = $e->__toString();
			var_dump('Exception String: '. $string);
			Log::debug('FAIL to upload profile photo!');

			exit;
		}

		return true;
	}


	public static function uploadPhoto(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		// root: po02\storage\tenantgeda\app
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();


		// get entity and directory
		$directory 		= 'logo';

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			//$request->file_to_upload->storeAs('private/pr/', $fileName);
			//$request->file_to_upload->storeAs('private/'.$directory.'/', $fileName);
			//$request->file_to_upload->storeAs($directory.'/', $fileName);
			//$request->file_to_upload->move(public_path('landlord/'.$directory), $fileName);
			$request->file_to_upload->storeAs('/', $fileName);

		} catch (Exception $e) {

			$message = $e->getMessage();
			var_dump('Exception Message: '. $message);

			$code = $e->getCode();
			var_dump('Exception Code: '. $code);

			$string = $e->__toString();
			var_dump('Exception String: '. $string);
			Log::debug('FAIL to upload profile photo!');

			exit;
		}
	
		return true;
	}

	// user in SetupController
	public static function uploadLogo(FormRequest $request)
	{
		//check https://stackoverflow.com/questions/50997652/laravel-retrieve-images-from-storage-to-view
		// 17-MAY-2023
		// OK. Store File in Storage Private Folder. Auto create folder
		// both file_to_upload and fileName is used
		// root: po02\storage\tenantgeda\app
		// set directory within default location i.e. po02\storage\tenantgeda\app
		$directory 		= 'logo';

		$fileName 		= date("YmdHis")."-".$request->file('file_to_upload')->getClientOriginalName();
		//Log::debug('fileName='.$fileName);

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->storeAs($directory.'/', $fileName);

			//resize to thumbnail
			$thumbImage 	= "logo." . trim($request->file('file_to_upload')->getClientOriginalExtension());
			$path = storage_path('app/'.$directory.'/'. $fileName);
			$image_resize = Image::make($path);
			$image_resize->fit(90, 90);
			$image_resize->save(storage_path('app/'.$directory.'/'. $thumbImage));
			return $thumbImage;

		} catch (Exception $e) {

			$message = $e->getMessage();
			var_dump('Exception Message: '. $message);

			$code = $e->getCode();
			var_dump('Exception Code: '. $code);

			$string = $e->__toString();
			var_dump('Exception String: '. $string);
			Log::debug('Failed to upload company logo!');

			exit;
		}

		// check on-hand stock
		//$user = User::find($request->user_id);
		// update profile photo
		//$user->photo = $fileName;
		//$user->save();
		return 1;
	}

	// user in UserController
	public static function uploadAvatar(FormRequest $request)
	{
		//check https://stackoverflow.com/questions/50997652/laravel-retrieve-images-from-storage-to-view
		// 17-MAY-2023
		// OK. Store File in Storage Private Folder. Auto create folder
		// both file_to_upload and fileName is used
		// root: po02\storage\tenantgeda\app
		// set directory within default location i.e. po02\storage\tenantgeda\app
		$directory 		= 'avatar';

		$fileName 		= date("YmdHis")."-".$request->file('file_to_upload')->getClientOriginalName();
		//Log::debug('fileName='.$fileName);

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->storeAs($directory.'/', $fileName);

			//resize to thumbnail
			$thumbImage 	= $request->input('id'). "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
			$path = storage_path('app/'.$directory.'/'. $fileName);
			$image_resize = Image::make($path);
			$image_resize->fit(90, 90);
			$image_resize->save(storage_path('app/'.$directory.'/'. $thumbImage));
			return $thumbImage;

		} catch (Exception $e) {

			$message = $e->getMessage();
			var_dump('Exception Message: '. $message);

			$code = $e->getCode();
			var_dump('Exception Code: '. $code);

			$string = $e->__toString();
			var_dump('Exception String: '. $string);
			Log::debug('Failed to upload profile photo!');

			exit;
		}

		// check on-hand stock
		//$user = User::find($request->user_id);
		// update profile photo
		//$user->photo = $fileName;
		//$user->save();
		return 1;
	}
}
