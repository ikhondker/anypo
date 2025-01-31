<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ItemController.php
* @brief		This file contains the implementation of the ItemController
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


use App\Http\Requests\Tenant\Lookup\StoreItemRequest;
use App\Http\Requests\Tenant\Lookup\UpdateItemRequest;

# 1. Models
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\ItemCategory;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\GlType;

use App\Models\Tenant\Manage\UomClass;
# 2. Enums
use App\Enum\EntityEnum;
# 3. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\Tenant\FileUpload;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
use DB;
use Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Exception;
# 12. FUTURE
# 1. dependent dropdown for uom

class ItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Item::class);

		$items = Item::query();
		if (request('term')) {
			$items->where('name', 'Like', '%' . request('term') . '%');
		}
		$items = $items->with('item_category')->with('uom')->with('oem')->with('glType')->orderBy('id', 'DESC')->paginate(25);
		return view('tenant.lookup.items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Item::class);

		$itemCategories = ItemCategory::primary()->get();

		$uomClasses = UomClass::All();

		$uoms = Uom::primary()->get();

		$oems = Oem::primary()->get();

		$gl_types = GlType::primary()->get();

		return view('tenant.lookup.items.create', compact('itemCategories','uomClasses','uoms', 'oems', 'gl_types'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreItemRequest $request)
	{
		$this->authorize('create', Item::class);

		// get uom to find uom_class_id
		$uom = Uom::where('id', $request->input('uom_id') )->first();

		$request->merge([
			'code' 			=> Str::upper($request['code']),
			'uom_class_id' 	=> $uom->uom_class_id,
			'ac_expense' 	=> Str::upper($request['ac_expense']),
		]);

		$item = Item::create($request->all());
		// Write to Log
		EventLog::event('item', $item->id, 'create');

		// Upload File
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $item->id ]);
			$request->merge(['entity'		=> EntityEnum::ITEM->value ]);
			$attid = FileUpload::aws($request);
		}

		return redirect()->route('items.index')->with('success', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Item $item)
	{
		$this->authorize('view', $item);

		return view('tenant.lookup.items.show', compact('item'));

	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Item $item)
	{
		$this->authorize('update', $item);

		$itemCategories = ItemCategory::primary()->get();
		$uoms = Uom::byUomClass($item->uom_class_id)->get();
		$oems = Oem::primary()->get();
		$gl_types = GlType::primary()->get();

		return view('tenant.lookup.items.edit', compact('item', 'itemCategories', 'uoms', 'oems', 'gl_types'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateItemRequest $request, Item $item)
	{
		$this->authorize('update', $item);

		$request->merge([
			'code' 			=> Str::upper($request['code']),
			'ac_expense' 	=> Str::upper($request['ac_expense']),
		]);

		//$request->validate();
		$request->validate([

		]);

		// Write to Log
		EventLog::event('item', $item->id, 'update', 'name', $item->name);
		$item->update($request->all());

		return redirect()->route('items.index')->with('success', 'Item updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Item $item)
	{
		$this->authorize('delete', $item);

		$item->fill(['enable' => !$item->enable]);
		$item->update();

		// Write to Log
		EventLog::event('item', $item->id, 'status', 'enable', $item->enable);

		return redirect()->route('items.index')->with('success', 'Item status Updated successfully');
	}

/**
	 * Display the specified resource.
	 */
	public function timestamp(Item $item)
	{
		$this->authorize('view', $item);

		return view('tenant.lookup.items.timestamp', compact('item'));
	}


	// add attachments
	public function chk_attach(FormRequest $request)
	{
		$this->authorize('create', Item::class);

		try {
			$item = Item::where('id', $request->input('attach_item_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error(' tenant.item.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Item Not Found!']);
		}
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_item_id')]);
			$request->merge(['entity'		=> EntityEnum::ITEM->value ]);
			$attid = FileUpload::aws($request);
		}
		return redirect()->back()->with('success', 'File Uploaded successfully.');
	}

	public function attachments(Item $item)
	{
		$this->authorize('view', $item);
		$item = Item::where('id', $item->id)->get()->firstOrFail();
		return view('tenant.lookup.items.attachments', compact('item'));
	}


	public function export()
	{

		$this->authorize('export', Item::class);

		$fileName = 'export-items-' . date('Ymd') . '.xls';
		$items = Item::with('item_category')->with('uom')->with('uom_class')->with('oem')->with('glType')->with('user_created_by')->with('user_updated_by');

		$items = $items->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'ID#');
		$sheet->setCellValue('B1', 'Name');
		$sheet->setCellValue('C1', 'Description');
		$sheet->setCellValue('D1', 'Category');
		$sheet->setCellValue('E1', 'OEM');
		$sheet->setCellValue('F1', 'UoM');
		$sheet->setCellValue('G1', 'Price');
		$sheet->setCellValue('H1', 'GL Type');
		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($items as $item){
			$sheet->setCellValue('A' . $rows, $item->id);
			$sheet->setCellValue('B' . $rows, $item->name);
			$sheet->setCellValue('C' . $rows, $item->notes);
			$sheet->setCellValue('D' . $rows, $item->item_category->name);
			$sheet->setCellValue('E' . $rows, $item->oem->name);
			$sheet->setCellValue('F' . $rows, $item->uom->name);
			$sheet->setCellValue('G' . $rows, $item->price);

			$sheet->setCellValue('H' . $rows, $item->glType->name);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');
	}

	// user in prl and pol dropdown ajax
	public function getItem($id = 0)
	{
		//http://demo1.localhost:8000/items/get-item/1005
		$data = [];
		//Log::info('id='.$id);
		//$data = Category::where('id', $id)->first();
		//{"id":3,"name":"Category -3","slug":"Neque non.","enable":1,"limit":30,"created_at":"2022-07-04T07:08:42.000000Z","updated_at":"2022-07-04T07:08:42.000000Z"}
		$data = Item::select('code','name','uom_class_id','price')->where('id', $id)->first();
		// {"limit":30,"slug":"Neque non."}
		//Log::info( $data);

		//Log::debug('Value of data=' . $data);
		return response()->json($data);

	}
}
