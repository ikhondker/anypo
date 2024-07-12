<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			UploadItemController.php
* @brief		This file contains the implementation of the UploadItemController
* @path			\App\Http\Controllers\Tenant\Lookup
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

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\UploadItem;
use Illuminate\Http\Request;

# 1. Models
use App\Models\Tenant\Lookup\Category;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\GlType;
# 2. Enums
use App\Enum\InterfaceStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
# 9. Exceptions
# 10. Events
# 11. Seeded
use Illuminate\Support\Facades\Log;
use DB;
use Str;
# 12. FUTURE

class UploadItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$this->authorize('viewAny', UploadItem::class);

		$upload_items = UploadItem::query();
		if (request('term')) {
			$upload_items->where('name', 'Like', '%' . request('term') . '%');
		}
		$upload_items = $upload_items->with('owner')->with('customError')->orderBy('id', 'DESC')->paginate(25);
		return view('tenant.lookup.upload-items.index', compact('upload_items'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', UploadItem::class);

		return view('tenant.lookup.upload-items.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{

		$this->authorize('create', UploadItem::class);

		$directory = 'bulk';

		$this->validate($request, [
			'file_to_upload' => 'required|file|mimes:xls,xlsx'
		]);

		// upload file as record
		if ($file = $request->file('file_to_upload')) {
			$fileName 		= date("YmdHis") . "-" . $request->file('file_to_upload')->getClientOriginalName();
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->storeAs('private/'.$directory.'/', $fileName);
		}

		// process file
		$the_file = $request->file('file_to_upload');

		// delete old records
		DB::table('upload_items')
			->where('status', '<>', InterfaceStatusEnum::UPLOADED->value)
			->delete();
		Log::debug('tenant.upload0item.destroy Interface data deleted.');

		try {
			$spreadsheet	= IOFactory::load($the_file->getRealPath());
			$sheet			= $spreadsheet->getActiveSheet();
			$row_limit		= $sheet->getHighestDataRow();
			$column_limit	= $sheet->getHighestDataColumn();
			$row_range		= range(2, $row_limit);
			$column_range	= range('H', $column_limit);
			$startcount		= 1;

			$created_at 	= now();
			$updated_at 	= now();
			//$created_at 	= date('Y-m-d H:i:s');
			//$updated_at 	= date('Y-m-d H:i:s');
			$owner_id		= auth()->user()->id;

			$data = array();
			foreach ($row_range as $row) {
				$data[] = [
					'owner_id'		=> $owner_id,
					'item_code'		=> Str::upper($sheet->getCell('A' . $row)->getValue()),
					'item_name'		=> $sheet->getCell('B' . $row)->getValue(),
					'notes'			=> $sheet->getCell('C' . $row)->getValue(),
					'category_name'	=> $sheet->getCell('D' . $row)->getValue(),
					'oem_name'		=> $sheet->getCell('E' . $row)->getValue(),
					'uom_name'		=> $sheet->getCell('F' . $row)->getValue(),
					'price'			=> $sheet->getCell('G' . $row)->getValue(),
					'gl_type_name'	=> $sheet->getCell('H' . $row)->getValue(),
					'ac_expense'	=> $sheet->getCell('I' . $row)->getValue(),
					'created_at'	=> $created_at,
					'updated_at'	=> $updated_at,
				];
				$startcount++;
			}

			// insert into table
			DB::table('upload_items')->insert($data);

		} catch (Exception $e) {
			$error_code = $e->errorInfo[1];
			return back()->withErrors('There was a problem uploading the data!');
		}

		//return back()->withSuccess('Great! Data has been successfully uploaded.');
		return redirect()->route('upload-items.index')->with('success', 'File uploaded successfully. Now run validations process.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(UploadItem $uploadItem)
	{
		$this->authorize('view', $uploadItem);

		return view('tenant.lookup.upload-items.show', compact('uploadItem'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(UploadItem $uploadItem)
	{

		$this->authorize('update', $uploadItem);
		return view('tenant.lookup.upload-items.edit', compact('uploadItem'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, UploadItem $uploadItem)
	{
		$this->authorize('update', $uploadItem);

		$request->merge([
			'item_code' => Str::upper($request['item_code']),
			'status'	=> InterfaceStatusEnum::DRAFT->value
		]);

		//$request->validate();
		$request->validate([

		]);

		$uploadItem->update($request->all());

		return redirect()->route('upload-items.index')->with('success', 'Interface items updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(UploadItem $uploadItem)
	{
		//
	}

	public function purge()
	{
		$this->authorize('purge', UploadItem::class);
		DB::table('upload_items')->delete();
		EventLog::event('UploadItem', 0, 'delete', 'id', 0);
		return redirect()->route('upload-items.index')->with('success', 'Interface items purged successfully.');

	}
	public function check()
	{

		$this->authorize('create', UploadItem::class);

		$upload_items = UploadItem::where('status', '<>', InterfaceStatusEnum::UPLOADED->value)
				->orderBy('id', 'DESC')
				->get();
		//dd($upload_items);

		// $upload_items = UploadItem::query();
		// if (request('term')) {
		//		$upload_items->where('name', 'Like', '%' . request('term') . '%');
		// }
		// $upload_items= $upload_items->orderBy('id', 'DESC')->paginate(10);
		// dd($upload_items);

		//$os = array("E", "A", "I");

		foreach ($upload_items as $upload_item) {
			$error_code = '';
			try {

				$item = Item::firstWhere('code', $upload_item->item_code);
				if(is_null($item)) {
					$code = '';
				} else {
					$code = $item->code;
					$error_code = 'E006';
					Log::debug('tenant.Lookup.UploadItemController.check code = ' . $code. ' exists!');
				}

				$category = Category::firstWhere('name', $upload_item->category_name);
				if(is_null($category)) {
					$category_id = '';
					$error_code = 'E007';
					Log::debug('tenant.Lookup.UploadItemController.check category = ' . $upload_item->category_name. ' not found!');
				} else {
					$category_id = $category->id;
				}

				$oem = OEM::firstWhere('name', $upload_item->oem_name);
				if(is_null($oem)) {
					$oem_id = '';
					$error_code = 'E008';
					Log::debug('tenant.Lookup.UploadItemController.check oem = ' . $upload_item->oem_name. ' not found!');
				} else {
					$oem_id = $oem->id;
				}

				$uom = Uom::firstWhere('name', $upload_item->uom_name);
				if(is_null($uom)) {
					$uom_class_id= '';
					$uom_id = '';
					$error_code = 'E009';
					Log::debug('tenant.Lookup.UploadItemController.check uom = ' . $upload_item->uom_name. ' not found!');
				} else {
					$uom_class_id 	= $uom->uom_class_id;
					$uom_id 		= $uom->id;
				}

				$gl_type = GLType::firstWhere('name', $upload_item->gl_type_name);
				if(is_null($gl_type)) {
					$gl_type = '';
					$error_code = 'E010';
					Log::debug('tenant.Lookup.UploadItemController.check gl_type = ' . $upload_item->gl_type_name. ' not found!');
				} else {
					$gl_type = $gl_type->code;
				}

				// $category = Category::where('name', $upload_item->category)->firstOrFail();
				// $oem = OEM::where('name', $upload_item->oem)->firstOrFail();
				// $uom = Uom::where('name', $upload_item->uom)->firstOrFail();

				Log::debug('Result => id = '.$upload_item->id.' category_id = '.$category_id.' oem_id = '.$oem_id.' uom_id = '.$uom_id.' gl_type = '.$gl_type);

				if ( $error_code <> '') {
					// Any error identified
					UploadItem::where('id', $upload_item->id)
						->update([
							'error_code'	=> $error_code,
							'status' 		=> InterfaceStatusEnum::ERROR->value
						]);
				} else {
					UploadItem::where('id', $upload_item->id)
						->update([
							'category_id'	=> $category_id,
							'oem_id'		=> $oem_id,
							'uom_class_id'	=> $uom_class_id,
							'uom_id'		=> $uom_id,
							'gl_type'		=> $gl_type,
							'ac_expense'	=> Str::upper('ac_expense'),
							'status'		=> InterfaceStatusEnum::VALIDATED->value,
							'error_code'	=> NULL,
						]);
				}

			} catch (Exception $e) {
				$error_code = $e->errorInfo[1];
				return back()->withErrors('There was a problem validating the data!');
			}
		}

		return redirect()->route('upload-items.index')->with('success', 'Validation process completed. Please review result.');

	}

	public function import()
	{

		$this->authorize('create', UploadItem::class);

		$upload_items = UploadItem::where('status', '=', InterfaceStatusEnum::VALIDATED->value)
			->orderBy('id', 'DESC')
			->get();

		foreach ($upload_items as $upload_item) {
			//id name notes code category_id oem_id uom_id price stock reorder account_type photo enable created_by created_at updated_by updated_at

			$item = [
				'code'			=> $upload_item->item_code,
				'name'			=> $upload_item->item_name,
				'notes'			=> $upload_item->notes,
				'category_id'	=> $upload_item->category_id,
				'oem_id'		=> $upload_item->oem_id,
				'uom_class_id'	=> $upload_item->uom_class_id,
				'uom_id'		=> $upload_item->uom_id,
				'price'			=> $upload_item->price,
				'gl_type'		=> $upload_item->gl_type,
				'ac_expense'	=> ($upload_item->ac_expense <> '') ? $upload_item->ac_expense : 'A600001' ,
			];

			Item::create($item); // don't forget to fill $fillable in Model
			UploadItem::where('id', $upload_item->id)
				->update(['status' => InterfaceStatusEnum::UPLOADED->value]);
		}

		return redirect()->route('upload-items.index')->with('success', 'Item uploaded successfully.');

	}

	public function export()
	{
		$this->authorize('export', UploadItem::class);

		$data = DB::select("SELECT i.id, u.name owner_name, i.name, i.code, i.notes, i.category, i.oem, i.uom, i.price, i.gl_type_name, i.status
			FROM upload_items i,users u
			WHERE i.owner_id=u.id");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('upload_items', $dataArray);
	}
}
