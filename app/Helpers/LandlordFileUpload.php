<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordFileUpload.php
* @brief		This file contains the implementation of the LandlordFileUpload
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

use App\Models\User;

use App\Models\Landlord\Manage\Attachment;
use App\Models\Landlord\Manage\Entity;


use File;
// use Illuminate\Support\Facades\File;

use Request;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LandlordFileUpload
{

	public static function aws(FormRequest $request)
	{

		$request->validate(['file_to_upload'	=> 'required|file|mimes:csv,eml,msg,zip,rar,doc,docx,xls,xlsx,pdf,jpg,png|max:1024']);

		if ($request->hasFile('file_to_upload')) {
			$file 			= $request->file('file_to_upload');
		} else {
			Log::error('Helpers.LandlordFileUpload.aws No file uploaded!');
			$attachment_id = 0;
			return $attachment_id;
		}

		if (! $file->isValid()) {
			Log::debug('Helpers.LandlordFileUpload.aws file is invalid!');
			$attachment_id = 0;
			return $attachment_id;
		}

		// ===> both file_to_upload and fileName is used
		//$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$fileName 		= $request->article_id.'-'. uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		// get tenant, entity and directory to upload
		$entity 		= Entity::where('entity', $request->entity)->first();
		$fileUploadPath = $entity->directory."/". $fileName;
		Log::debug('Helpers.LandlordFileUpload.aws Value of fileUploadPath ='. $fileUploadPath);
			
		try {
			//Code that may throw an Exception
			// OK. Store File in Storage Private Folder. Auto create folder
			//$request->file_to_upload->storeAs('private/' . $directory . '/', $fileName);

			$path= Storage::disk('s3lf')->put($fileUploadPath, file_get_contents($file));
			Log::debug('Helpers.LandlordFileUpload.aws Value of path='. $path);

			// create Attachment record rewrite
			$attachment					= new Attachment;
			$attachment->article_id		= $request->article_id;
			$attachment->entity			= $request->entity;
			$attachment->file_entity 	= ($request->has('file_entity')) ? $request->file_entity : $request->entity;

			$attachment->owner_id		= auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');

			$attachment->summary		= ($request->has('summary')) ? $request->summary : 'No Details';
			$attachment->file_name		= $fileName;
			$attachment->org_file_name	= $org_fileName;
			$attachment->file_type	 	= $request->file('file_to_upload')->getMimeType();
			$attachment->file_size	 	= $request->file('file_to_upload')->getSize();
			$attachment->upload_date	= now(); //date('Y-m-d H:i:s');

			$attachment->save();
			$attachment_id				=$attachment->id;
		} catch (Exception $e) {
			// Log the message locally OR use a tool like Bugsnag/Flare to log the error
			Log::error('LandlordFileUpload.upload '.$e->getMessage());
			// Either form a friendlier message to display to the user OR redirect them to a failure page
			$attachment_id = 0;
		}
		
		return $attachment_id;
	}

	public static function upload(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		// get entity and directory
		$entity 		= Entity::where('entity', $request->entity)->first();
		$directory 		= $entity->directory;

		try {
			// Code that may throw an Exception
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->storeAs('private/' . $directory . '/', $fileName);

			Log::debug('ll.upload Value of directory=' . $directory);
			// create Attachment record rewrite
			$attachment					= new Attachment;
			$attachment->article_id		= $request->article_id;
			$attachment->entity			= $request->entity;
			$attachment->file_entity 	= ($request->has('file_entity')) ? $request->file_entity : $request->entity;

			$attachment->owner_id		= auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');

			$attachment->summary		= ($request->has('summary')) ? $request->summary : 'No Details';
			$attachment->file_name		= $fileName;
			$attachment->org_file_name	= $org_fileName;
			$attachment->file_type	 	= $request->file('file_to_upload')->getMimeType();
			$attachment->file_size	 	= $request->file('file_to_upload')->getSize();
			$attachment->upload_date	= now(); //date('Y-m-d H:i:s');

			$attachment->save();
			$attachment_id				=$attachment->id;
		} catch (Exception $e) {
			// Log the message locally OR use a tool like Bugsnag/Flare to log the error
			Log::error('LandlordFileUpload.upload '.$e->getMessage());
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
			$request->file_to_upload->move(public_path('landlord/' . $directory), $fileName);
		} catch (Exception $e) {

			$message = $e->getMessage();
			var_dump('Exception Message: ' . $message);

			$code = $e->getCode();
			var_dump('Exception Code: ' . $code);

			$string = $e->__toString();
			var_dump('Exception String: ' . $string);
			Log::debug('FAIL to upload profile photo!');

			exit;
		}

		return true;
	}


	public static function uploadPhoto(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		// get entity and directory
		$directory 		= 'profile';

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			//$request->file_to_upload->storeAs('private/pr/', $fileName);
			//$request->file_to_upload->move(public_path('landlord/'.$directory), $fileName);
			$request->file_to_upload->storeAs('public/' . $directory . '/', $fileName);

		} catch (Exception $e) {

			$message = $e->getMessage();
			var_dump('Exception Message: ' . $message);

			$code = $e->getCode();
			var_dump('Exception Code: ' . $code);

			$string = $e->__toString();
			var_dump('Exception String: ' . $string);
			Log::debug('FAIL to upload profile photo!');

			exit;
		}

		return true;
	}
}
