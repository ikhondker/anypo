<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			AttachmentController.php
* @brief		This file contains the implementation of the AttachmentController
* @path			\app\Http\Controllers\Landlord\Manage
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
namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreAttachmentRequest;
use App\Http\Requests\Landlord\Manage\UpdateAttachmentRequest;

// Models
use App\Models\Landlord\Manage\Attachment;
use App\Models\Landlord\Manage\Entity;
//use App\Models\Emp;
// Enums

// Helpers
use App\Helpers\FileUpload;
use App\Helpers\LandlordEventLog;

// Seeded
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use File;
use Illuminate\Support\Facades\Storage;


class AttachmentController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		//$this->authorize('view',Attachment::class);
		//$this->authorize('viewAny',Attachment::class);
		//$this->authorize('view');

		// SALADV/EXPCERT/LIBRARY/LEAVE/PR/PAY/SPF/FDR/AR/ISSUE/RCV/LEAD/MEET
		//$orders = Order::latest()->with('user_created_by','product')->orderBy('id','desc')->paginate(10);
		$attachments = Attachment::latest()->with('entity')->orderBy('id','desc')->paginate(10);
		return view('landlord.manage.attachments.index',compact('attachments'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//abort(500, 'Can not create attachments Manually!');
		//abort( response('Can not create attachments manually!', 401) );
		//$this->authorize('create',Attachment::class);
		return view('landlord.manage.attachments.create');
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

		// Upload File, in private folder if any, insert row in attachment table  and get attachments id
		// if ($file = $request->file('file_to_upload')) {
		//    $request->merge(['entity'      => $request->entity ]);
		//    $request->merge(['emp_id'      => $request->emp_id ]);
		//    $request->merge(['article_id'  => $request->emp_id ]);
		//    $attid = FileUpload::upload($request);
		// } else{
			//     unset($input['image']);
			// }

		//$attachment = Attachment::create($input);
		//$attachment = Attachment::create($request->all());
		// Write to Log
		//LandlordEventLog::event('attachment',$attid,'create');

		// $request->validate([
		//     'name' => 'required',
		//     'email' => 'required|email|unique:users',
		//     'password' => 'required|min:6',
		//     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		// ]);

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
		//
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

	public function download($filename)
	{
		// TODO simplify
		// get entity -> subdir from filename
		$att = Attachment::where('file_name', $filename)->first();
		$entity = Entity::where('entity', $att->entity)->first();
		$subdir = $entity->subdir;

		//Log::debug('filename= '. $filename);
		//Log::debug('subdir= '. $subdir);

		//shown as: http://geda.localhost:8000/image/4.jpg
		//$path = storage_path('uploads/' . $filename);
		//$path = storage_path('app/private/pr/'. $filename);
		//$path = storage_path('app/private/adv/'. $filename);
		$path = storage_path('app/private/'.$subdir.'/'. $filename);
		Log::debug('path1= '. $path);

		if (!File::exists($path)) {
			abort(404);
		} 

		$file = File::get($path);
		$type = File::mimeType($path);
		Log::debug('type'. $type);

		
		ob_end_clean();
		// $headers = array(
		// 	'Content-Type: image/png',
		// );
		return Storage::disk('local')->download('private/'.$subdir.'/'. $filename, $filename,["Content-Type", $type]);


		//Log::debug('storage url:'. Storage::url('file.jpg'));
		//Log::debug(storage_path('fie.jpg'));
		//Log::debug('type'. $type);
		//Storage::url
		//storage_path()

		//path1= D:\laravel\bo05\storage\app/private/landlord/comment/6550e59ed9acf.jpg  
		//[2023-11-16 05:11:24] local.DEBUG: storage url/storage/file.jpg 
		// Storage::download(Storage::url($image->image), $image->title);
		//return Storage::download(Storage::url('app/private/landlord/comment/6550e59ed9acf.jpg'), $filename);
		//return Storage::download($path);

		//Storage::download("app/".$this->pdf->{File::PATH});
		//Storage::download("app/".$this->pdf->{File::PATH});


		// return Storage::download("app/private/landlord/comment/6550e59ed9acf.jpg",$filename);
		// if (Storage::disk('s3')->exists('reports/' . $report->type . '' . $report->uuid . '.xlsx')) { 
		// 	$url = Storage::url('reports/' . $report->type . '' . $report->uuid . '.xlsx'); 
		// 	return redirect($url); 
		// }

		//$url = Storage::url('/app/private/landlord/comment/6550e59ed9acf.jpg'); 
		//return redirect($url); 
		//return Storage::download('app/blockbuster.pdf');
		// OK
		//return Storage::disk('local')->download('CuEhnp3.png');
		// ok for not image
		// https://laracasts.com/discuss/channels/laravel/how-to-read-file-from-private-disk-in-laravel
		
		//return Storage::disk('local')->download('private/'.$subdir.'/'. $filename, $filename, ["Content-Type", $type]);
		//return Storage::download('file.jpg', $name, $headers);

		// ob_end_clean();
		// $headers = array(
		// 	'Content-Type: image/png',
		// );
		// return Storage::disk('local')->download('private/'.$subdir.'/'. $filename, $filename);


		//header('Content-type: image/jpeg;');
		//header("Content-Length: " . strlen($imagefile));
	}


}
