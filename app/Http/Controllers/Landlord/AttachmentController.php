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

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreAttachmentRequest;
use App\Http\Requests\Landlord\UpdateAttachmentRequest;

# 1. Models
use App\Models\Landlord\Attachment;
use App\Models\Landlord\Manage\Entity;
# 2. Enums
# 3. Helpers
use App\Helpers\Landlord\FileUpload;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
use Illuminate\Database\Eloquent\ModelNotFoundException;
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use File;
# 13. FUTURE


class AttachmentController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort(500, 'Can not create attachments manually!');
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(500, 'Can not create attachments manually!');
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
		abort(500, 'Can not create attachments manually!');

		// $this->authorize('create',Attachment::class);
		// FileUpload::uploadPublicPhoto($request);
		// return redirect()->route('attachments.index')->with('success','Attachment created successfully.');

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
		return view('landlord.attachments.show',compact('attachment'));
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
		return view('landlord.attachments.edit', compact('attachment'));
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
		$this->authorize('update', $attachment);
		$attachment->update($request->all());

		// Write to Log
		EventLog::event('attachment', $attachment->id, 'update', 'name', $attachment->id);

		return redirect()->route('attachments.index')->with('success', 'Attachment updated successfully');
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

	public function all()
	{
		$this->authorize('viewAny',Attachment::class);
		$attachments = Attachment::latest()->with('entity')->with('owner')->orderBy('id','desc')->paginate(10);
		return view('landlord.attachments.all',compact('attachments'));
	}


	public function download(Attachment $attachment)
	{

		$this->authorize('download', $attachment);

		Log::debug('tenant.attachments.download Value of attachment_id = '. $attachment->id);
		Log::debug('tenant.attachments.download Value of file_name = '. $attachment->org_file_name);
		Log::debug('tenant.attachments.download Value of entity = '. $attachment->entity);

		$entity 			= Entity::where('entity', $attachment->entity)->first();
		$fileDownloadPath 	= $entity->directory."/". $attachment->file_name;
		Log::debug('landlord.attachments.download Value of fileDownloadPath = '. $fileDownloadPath);
		return Storage::disk('s3lf')->download($fileDownloadPath,$attachment->org_file_name);

	}

	public function chkdownloadLocal($filename)
	{
		// get entity -> directory from filename

		Log::debug('ll.download Value of download = ' . $filename);

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
