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

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Attachment;
use App\Http\Requests\Tenant\StoreAttachmentRequest;
use App\Http\Requests\Tenant\UpdateAttachmentRequest;


# 1. Models
use App\Models\Tenant\Manage\Entity;

use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Invoice;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\Tenant\InvoiceStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
use App\Helpers\Tenant\FileUpload;
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
use Illuminate\Foundation\Http\FormRequest;
use Exception;
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
		abort(403);
	}

	/**
	 * Display a listing of the resource.
	 */
	public function all()
	{
		$this->authorize('viewAny', Attachment::class);

		$attachments = Attachment::query();
		if (request('term')) {
			$attachments->where('entity', 'Like', '%' . Str::upper(request('term')) . '%');
		}
		$attachments = $attachments->with('owner')->orderBy('id', 'DESC')->paginate(50);
		return view('tenant.attachments.all', compact('attachments'));
		// $attachments = Attachment::latest()->orderBy('id', 'desc')->paginate(25);
		// return view('attachments.index',compact('attachments'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}


	// add attachments
	public function add(FormRequest $request, $entity, $articleId)
	{
		Log::debug('tenant.attachment.add entity=' . $entity);
		Log::debug('tenant.attachment.add articleId=' . $articleId);
		//if(empty($deptBudget)){
		// $this->authorize('create', Item::class);

		try {
			switch ($entity) {
				case EntityEnum::ITEM->value:
					$item = Item::where('id', $articleId)->first();
					if ($item === null) {
						// Item doesn't exist
						return redirect()->back()->with(['error' => 'Items Not Found!']);
					}
					break;
				case EntityEnum::SUPPLIER->value:
					$supplier = Supplier::where('id', $articleId)->first();
					if ($supplier === null) {
						// Item doesn't exist
						return redirect()->back()->with(['error' => 'Supplier Not Found!']);
					}
					break;
				case EntityEnum::PROJECT->value:
					$project = Project::where('id', $articleId)->first();
					if ($project === null) {
						// Item doesn't exist
						return redirect()->back()->with(['error' => 'Project Not Found!']);
					}
					break;
				case EntityEnum::BUDGET->value:
					$budget = Budget::where('id',$articleId)->get()->firstOrFail();
					if ($budget === null) {
						// Budget doesn't exist
						return redirect()->back()->with(['error' => 'Budget Not Found!']);
					} else {
						if ($budget->closed){
							return redirect()->route('budgets.show', $budget->id)->with('error', 'Add attachment is allowed only for open Budget.');
						}
					}
					break;
				case EntityEnum::DEPTBUDGET->value:
						$deptBudget = DeptBudget::where('id', $articleId)->get()->firstOrFail();
						if ($deptBudget === null) {
							// BuddeptBudgetget doesn't exist
							return redirect()->back()->with(['error' => 'Dept Budget Not Found!']);
						} else {
							if ($deptBudget->closed){
								return redirect()->route('dept-budgets.show', $deptBudget->id)->with('error', 'Add attachment is only allowed for open Budget.');
							}
						}
						break;
				case EntityEnum::INVOICE->value:
					$invoice = Invoice::where('id', $articleId)->get()->firstOrFail();
					if ($invoice === null) {
						// invoice doesn't exist
						return redirect()->back()->with(['error' => 'Invoice Not Found!']);
					} else {
						if ($invoice->status <> InvoiceStatusEnum::DRAFT->value){
							return redirect()->route('invoices.show', $invoice->id)->with('error', 'Add attachment is only allowed for DRAFT Invoice.');
						}
					}
					break;
				case EntityEnum::PR->value:
					$pr = Pr::where('id', $articleId)->get()->firstOrFail();
					if ($pr === null) {
						// PR doesn't exist
						return redirect()->back()->with(['error' => 'Invoice Not Found!']);
					} else {
						if ($pr->auth_status <> AuthStatusEnum::DRAFT->value){
							return redirect()->route('prs.show', $pr->id)->with('error', 'Add attachment is only allowed for DRAFT Requisition.');
						}
					}
				   break;
				case EntityEnum::PO->value:
					$po = Po::where('id', $articleId)->get()->firstOrFail();
					if ($po === null) {
						// PO doesn't exist
						return redirect()->back()->with(['error' => 'Invoice Not Found!']);
					} else {
						if ($po->auth_status <> AuthStatusEnum::DRAFT->value){
							return redirect()->route('pos.show', $po->id)->with('error', 'Add attachment is only allowed for DRAFT PO.');
						}
					}
					break;
				default:
					return redirect()->back()->with('error', 'Unknown Entity. File Upload Error!');
				}
			} catch (Exception $e) {
				Log::error(' tenant.item.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
				return redirect()->back()->with(['error' => 'Article Not Found!']);
			}


		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $articleId]);
			$request->merge(['entity'		=> $entity]);
			$attid = FileUpload::aws($request);
		}

		// try {
		// 	$item = Item::where('id', $request->input('attach_item_id'))->get()->firstOrFail();
		// } catch (Exception $e) {
		// 	Log::error(' tenant.item.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
		// 	return redirect()->back()->with(['error' => 'Item Not Found!']);
		// }
		// if ($file = $request->file('file_to_upload')) {
		// 	$request->merge(['article_id'	=> $request->input('attach_item_id')]);
		// 	$request->merge(['entity'		=> EntityEnum::ITEM->value ]);
		// 	$attid = FileUpload::aws($request);
		// }
		return redirect()->back()->with('success', 'File Uploaded successfully.');
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
		return view('tenant.attachments.show', compact('attachment'));

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
		$this->authorize('update', $attachment);

		return view('tenant.attachments.edit', compact('attachment'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAttachmentRequest $request, Attachment $attachment)
	{
		$this->authorize('update', $attachment);

		//$request->validate();
		$request->validate([
		]);

		//Log::debug('Value of id=' . $attachment->id);
		//Log::debug('Value of summary = ' . $attachment->summary);

		// Write to Log
		EventLog::event('attachment', $attachment->id, 'update', 'summary', $request->summary);
		$attachment->update($request->all());

		$msg = 'Attachment information updated successfully';
		switch ($attachment->entity) {
			case EntityEnum::BUDGET->value:
				return redirect()->route('budgets.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::DEPTBUDGET->value:
				return redirect()->route('dept-budgets.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::PR->value:
				return redirect()->route('prs.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::PO->value:
				return redirect()->route('pos.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::PROJECT->value:
				return redirect()->route('projects.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::RECEIPT->value:
				return redirect()->route('receipts.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::INVOICE->value:
				return redirect()->route('invoices.attachments',$attachment->article_id)->with('success', $msg );
				break;
			case EntityEnum::PAYMENT->value:
				return redirect()->route('payments.attachments',$attachment->article_id)->with('success', $msg );
				break;
			default:
				return redirect()->route('dashboard.index')->with('success', $msg);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Attachment $attachment)
	{
		// TODOP2 need to delete actual file form aws
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
			case EntityEnum::ITEM->value:
				EventLog::event('Item',$attachment->article_id, 'detach', 'id', $attachment->id);
				$attachment->delete();
				return redirect()->back()->with('success', 'Attachment deleted!');
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
			case EntityEnum::SUPPLIER->value:
				EventLog::event('Supplier',$attachment->article_id, 'detach', 'id', $attachment->id);
				$attachment->delete();
				return redirect()->back()->with('success', 'Attachment deleted!');
				break;
			 default:
				Log::error(tenant('id'). 'tenant.attachment.destroy un-matched entity = '.$attachment->entity.' id = ' . $attachment->id);
				return redirect()->back()->with('error', 'Unknown Error. Attachment could not be deleted!');
		}
	}

	public function download(Attachment $attachment)
	{
		// TODOP2 check
		$this->authorize('download', Attachment::class);

		Log::debug('tenant.attachments.download Value of attachment_id = '. $attachment->id);
		Log::debug('tenant.attachments.download Value of file_name = '. $attachment->org_file_name);
		Log::debug('tenant.attachments.download Value of entity = '. $attachment->entity);
		// Log::debug('tenant.attachments.download Value of fileName = ' . $fileName);
		// try {
		// 	$attachment 				= Attachment::where('file_name', $fileName)->firstOrFail();
		// } catch (ModelNotFoundException $exception) {
		// 	 return redirect()->route('dashboards.index')->with('error', 'Attachment Not Found!');
		// }

		// get entity -> directory from filename
		//$att 				= Attachment::where('file_name', $fileName)->first();
		$entity 			= Entity::where('entity', $attachment->entity)->first();
		$fileDownloadPath 	= tenant('id')."/".$entity->directory."/". $attachment->file_name;
		Log::debug('tenant.attachments.download Value of fileDownloadPath = '. $fileDownloadPath);
		return Storage::disk('s3tf')->download($fileDownloadPath, $attachment->org_file_name);
	}

	public function downloadLocal($filename)
	{

		$this->authorize('download', Attachment::class);

		// TODOP2 simplify
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
