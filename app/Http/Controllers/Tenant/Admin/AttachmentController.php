<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AttachmentController.php
* @brief		This file contains the implementation of the AttachmentController
* @path			\App\Http\Controllers\Tenant\Admin
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

namespace App\Http\Controllers\Tenant\Admin;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Admin\Attachment;
use App\Http\Requests\Tenant\Admin\StoreAttachmentRequest;
use App\Http\Requests\Tenant\Admin\UpdateAttachmentRequest;


# 1. Models
use App\Models\Tenant\Manage\Entity;
use App\Models\Tenant\Lookup\Project;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Invoice;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\AuthStatusEnum;
use App\Enum\InvoiceStatusEnum;
# 3. Helpers
use App\Helpers\Export;
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
use DB;
use Str;
use File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
# 13. FUTURE
# 1. Allow Edit attachment summary
# 2.

class AttachmentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Attachment::class);

		$attachments = Attachment::query();
		if (request('term')) {
			$attachments->where('entity', 'Like', '%' . Str::upper(request('term')) . '%');
		}
		$attachments = $attachments->with('owner')->orderBy('id', 'DESC')->paginate(50);
		return view('tenant.admin.attachments.index', compact('attachments'));


		//$attachments = Attachment::latest()->orderBy('id', 'desc')->paginate(25);
		//return view('attachments.index',compact('attachments'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreAttachmentRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Attachment $attachment)
	{
		$this->authorize('view', $attachment);

		return view('tenant.admin.attachments.show', compact('attachment'));

		// switch ($attachment->entity) {
		// 	case EntityEnum::BUDGET->value:
		// 		return redirect()->route('budgets.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::DEPTBUDGET->value:
		// 		return redirect()->route('dept-budgets.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::PR->value:
		// 		return redirect()->route('prs.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::PO->value:
		// 		return redirect()->route('pos.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::PROJECT->value:
		// 		return redirect()->route('projects.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::RECEIPT->value:
		// 		return redirect()->route('receipts.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::INVOICE->value:
		// 		return redirect()->route('invoices.show', $attachment->article_id);
		// 		break;
		// 	case EntityEnum::PAYMENT->value:
		// 		return redirect()->route('payments.show', $attachment->article_id);
		// 		break;
		// 	default:
		// 		return redirect()->route('tenant.attachments.index');
		// 		// Success
		// }

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Attachment $attachment)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAttachmentRequest $request, Attachment $attachment)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Attachment $attachment)
	{
		// TODO need to delete actual file form aws
		$this->authorize('delete', $attachment);

		switch ($attachment->entity) {
			case EntityEnum::BUDGET->value:
				$budget = Budget::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($budget->closed) {
					return redirect()->back()->with('error', 'Attachment can not be deleted from closed Budget!');
				} else {
					EventLog::event('Budget', $budget->id, 'detach', 'id', $attachment->id);
					$attachment->delete();
					return redirect()->back()->with('success', 'Attachment deleted!');
				}
				break;
			case EntityEnum::DEPTBUDGET->value:
				$deptBudget = DeptBudget::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($deptBudget->closed) {
					return redirect()->back()->with('error', 'Attachment can not be deleted from closed Budget!');
				} else {
					EventLog::event('DeptBudget', $deptBudget->id, 'detach', 'id', $attachment->id);
					$attachment->delete();
					return redirect()->back()->with('success', 'Attachment deleted!');
				}
				break;
			case EntityEnum::PR->value:
				$pr = Pr::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
					return redirect()->back()->with('error', 'Attachment can be deleted only from DRAFT documents!');
				} else {
					EventLog::event('Pr', $pr->id, 'detach', 'id', $attachment->id);
					$attachment->delete();
					return redirect()->back()->with('success', 'Attachment deleted!');
				}
				break;
			case EntityEnum::PO->value:
				$po = PO::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
					return redirect()->back()->with('error', 'Attachment can be deleted only from DRAFT documents!');
				} else {
					EventLog::event('Po', $po->id, 'detach', 'id', $attachment->id);
					$attachment->delete();
					return redirect()->back()->with('success', 'Attachment deleted!');
				}
				break;
			case EntityEnum::PROJECT->value:
				$project = Project::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($project->closed) {
					return redirect()->back()->with('error', 'Attachment can not be deleted from closed project!');
				} else {
					EventLog::event('Project', $project->id, 'detach', 'id', $attachment->id);
					$attachment->delete();
					return redirect()->back()->with('success', 'Attachment deleted!');
				}
				break;
			case EntityEnum::RECEIPT->value:
				return redirect()->back()->with('error', 'Attachment can not be deleted from receipts!');
				break;
			case EntityEnum::INVOICE->value:
				$invoice = Invoice::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($invoice->status <> InvoiceStatusEnum::DRAFT->value) {
					return redirect()->back()->with('error', 'Attachment can not be deleted from closed project!');
				} else {
					EventLog::event('invoice', $invoice->id, 'detach', 'id', $attachment->id);
					$attachment->delete();
					return redirect()->back()->with('success', 'Attachment deleted!');
				}
				break;
			case EntityEnum::PAYMENT->value:
				return redirect()->back()->with('error', 'Attachment can not be deleted from Payment!');
				break;
			default:
				Log::error(tenant('id'). 'tenant.attachment.destroy un-matched entity = '.$attachment->entity.' id = ' . $attachment->id);
				return redirect()->back()->with('error', 'Unknown Error!');
		}


	}

	public function download($fileName)
	{

		Log::debug('tenant.attachments.download Value of fileName = ' . $fileName);
		try {
			$attachment 				= Attachment::where('file_name', $fileName)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			 return redirect()->route('dashboards.index')->with('error', 'Attachment Not Found!');
		}


		$this->authorize('download', Attachment::class);

		// get entity -> directory from filename
		//$att 				= Attachment::where('file_name', $fileName)->first();
		$entity 			= Entity::where('entity', $attachment->entity)->first();
		$fileDownloadPath 	= tenant('id')."/".$entity->directory."/". $fileName;
		Log::debug('tenant.attachments.download Value of fileDownloadPath = '. $fileDownloadPath);
		return Storage::disk('s3tf')->download($fileDownloadPath);
	}

	public function downloadLocal($filename)
	{

		$this->authorize('download', Attachment::class);

		// P2 simplify
		// get entity -> directory from filename
		$att = Attachment::where('file_name', $filename)->first();
		$entity = Entity::where('entity', $att->entity)->first();
		$directory = $entity->directory;

		//shown as: http://geda.localhost:8000/image/4.jpg
		//$path = storage_path('uploads/' . $filename);
		//$path = storage_path('app/private/pr/'. $filename);
		//$path = storage_path('app/private/adv/'. $filename);
		$path = storage_path('app/private/'.$directory.'/'. $filename);

		// if (!File::exists($path)) {
		// 	abort(404);
		// }

		// $file = File::get($path);
		// $type = File::mimeType($path);

		// $response = Response::make($file, 200);
		// $response->header("Content-Type", $type);
		// return $response;

		return Storage::disk('s3tf')->download('demo1-65e4b5d819dc8-uploaded.pdf');
		return Storage::disk('s3tf')->download('demo1-65e4b5d819dc8-uploaded.pdf');
	}



	/**
	 * Export selected column to csv format
	 */
	public function export()
	{
		$this->authorize('export', Attachment::class);

		//$data = Uom::all()->toArray();
		$data = DB::select('SELECT a.id, a.entity, a.article_id, u.name owner_name, a.org_file_name, upload_date
			FROM attachments a, users u
			WHERE a.owner_id = u.id
			');

		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return Export::csv('attachments', $dataArray);
	}
}
