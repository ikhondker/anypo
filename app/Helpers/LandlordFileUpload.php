<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        FileUpload.php
 * @brief       This file contains the implementation of the FileUpload Helper.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * 20-Sep-2023	v1.0.1	Iqbal H Khondker		Modification brief.
 * ==================================================================================
 */

namespace App\Helpers;

use App\Models\User;

use App\Models\Landlord\Attachment;
use App\Models\Landlord\Admin\Entity;


use File;
// use Illuminate\Support\Facades\File;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class LandlordFileUpload
{

	public static function upload(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		//Log::debug('fileName='.$fileName);
		//Log::debug('org_fileName='.$org_fileName);

		// get entity and subdir
		$entity 		= Entity::where('entity', $request->entity)->first();
		$subdir 		= $entity->subdir;

		// OK. Store File in Storage Private Folder. Auto create folder
		//$request->file_to_upload->storeAs('private/pr/', $fileName);
		$request->file_to_upload->storeAs('private/' . $subdir . '/', $fileName);

		// create Attachment record TODO rewrite
		$attachment                 	= new Attachment;
		$attachment->article_id        	= $request->article_id;
		$attachment->entity   			= $request->entity;
		$attachment->file_entity   		= ($request->has('file_entity')) ? $request->file_entity : $request->entity;

		$attachment->owner_id   		= auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');
		// $attachment->emp_id   		= ($request->has('emp_id')) ? $request->emp_id : Auth::user()->emp_id;

		$attachment->summary   			= ($request->has('summary')) ? $request->summary : 'No Details';
		$attachment->file_name   		= $fileName;
		$attachment->org_file_name   	= $org_fileName;
		$attachment->file_type   		= $request->file('file_to_upload')->getMimeType();
		$attachment->file_size   		= $request->file('file_to_upload')->getSize();
		$attachment->upload_date   		= now(); //date('Y-m-d H:i:s');
		//$attachment = Attachment::create($input);

		$attachment->save();

		// try {
		//     $uploadedFile->storeAs(
		//         $path,
		//         $fileName,
		//         $fileSystem
		//     );
		//     return $fileName;
		// } catch ( \Exception $e ) {
		//     throw new \Exception($e);
		// }

		return $attachment->id;
	}

	public static function uploadPublicPhoto(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		//Log::debug('fileName='.$fileName);
		//Log::debug('org_fileName='.$org_fileName);

		// get entity and subdir
		$subdir 		= 'profile';

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->move(public_path('landlord/' . $subdir), $fileName);
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

		// check on-hand stock
		// show <img src="{{ asset('/landlord/profile/643d1fe033c85.PNG') }}" style="height: 50px;width:100px;">
		return true;
	}


	public static function uploadPhoto(FormRequest $request)
	{

		// ===> both file_to_upload and filename is used
		$fileName 		= uniqid() . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());
		$org_fileName 	= $request->file('file_to_upload')->getClientOriginalName();

		//Log::debug('fileName='.$fileName);
		//Log::debug('org_fileName='.$org_fileName);

		// get entity and subdir
		$subdir 		= 'profile';

		try {
			// OK. Store File in Storage Private Folder. Auto create folder
			//$request->file_to_upload->storeAs('private/pr/', $fileName);
			$request->file_to_upload->storeAs('public/' . $subdir . '/', $fileName);
			//$request->file_to_upload->move(public_path('landlord/'.$subdir), $fileName);

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

		// check on-hand stock
		//$user = User::find($request->user_id);
		// update profile photo
		//$user->photo = $fileName;
		//$user->save();
		return 1;
	}
}
