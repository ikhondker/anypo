<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AttachmentController.php
* @brief		This file contains the implementation of the AttachmentController
* @path			\app\Http\Controllers\Landlord\Manage
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreAttachmentRequest;
use App\Http\Requests\Landlord\Manage\UpdateAttachmentRequest;

# 1. Models
use App\Models\Landlord\Manage\Attachment;
use App\Models\Landlord\Manage\Entity;
# 2. Enums
# 3. Helpers
use App\Helpers\FileUpload;
use App\Helpers\LandlordEventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use File;
# 13. TODO 



class AttachmentController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->authorize('viewAny',Attachment::class);
		$attachments = Attachment::latest()->with('entity')->with('owner')->orderBy('id','desc')->paginate(10);
		return view('landlord.manage.attachments.index',compact('attachments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(500, 'Can not create attachments Manually!');
		//abort( response('Can not create attachments manually!', 401) );
		//$this->authorize('create',Attachment::class);
		//return view('landlord.manage.attachments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreAttachmentRequest  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(StoreAttachmentRequest $request)
	{
		$this->authorize('create',Attachment::class);
		FileUpload::uploadPublicPhoto($request);
		return redirect()->route('attachments.index')->with('success','Attachment created successfully.');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Attachment  $attachment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Attachment $attachment)
	{
		$this->authorize('view', $attachment);
		return view('landlord.manage.attachments.show',compact('attachment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Attachment  $attachment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Attachment $attachment)
	{
		$this->authorize('update',$attachment);
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateAttachmentRequest  $request
	 * @param  \App\Models\Attachment  $attachment
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateAttachmentRequest $request, Attachment $attachment)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Attachment  $attachment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Attachment $attachment)
	{
		abort(403);
	}

	public function download($fileName)
	{
		//$this->authorize('download', Attachment::class);

		Log::debug('landlord.attachments.download Value of fileName='. $fileName);
		// get entity -> directory from filename
		$att 				= Attachment::where('file_name', $fileName)->first();
		$entity 			= Entity::where('entity', $att->entity)->first();
		$fileDownloadPath 	= $entity->directory."/". $fileName;
		Log::debug('landlord.attachments.download Value of fileDownloadPath='. $fileDownloadPath);
		return Storage::disk('s3lf')->download($fileDownloadPath);
	}

	public function downloadLocal($filename)
	{
		// get entity -> directory from filename

		Log::debug('ll.downalod Value of downalod=' . $filename);

		$att = Attachment::where('file_name', $filename)->first();
		$entity = Entity::where('entity', $att->entity)->first();
		$directory = $entity->directory;

		$path = storage_path('app/private/'.$directory.'/'. $filename);

		if (!File::exists($path)) {
			abort(404);
		} 

		$file = File::get($path);
		$type = File::mimeType($path);
		
		ob_end_clean();
		return Storage::disk('local')->download('private/'.$directory.'/'. $filename, $filename,["Content-Type", $type]);
	}
}
