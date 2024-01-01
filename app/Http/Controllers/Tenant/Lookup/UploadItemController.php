<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\UploadItem;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Illuminate\Support\Facades\Log;
use App\Enum\InterfaceStatusEnum;

use DB;

use App\Models\Tenant\Lookup\Category;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\GlType;
use App\Helpers\Export;

class UploadItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$upload_items = UploadItem::query();
		if (request('term')) {
			$upload_items->where('name', 'Like', '%' . request('term') . '%');
		}
		$upload_items = $upload_items->orderBy('id', 'DESC')->paginate(25);
		return view('tenant.lookup.upload-items.index', compact('upload_items'))->with('i', (request()->input('page', 1) - 1) * 25);
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

		$subdir = 'bulk';

		$this->validate($request, [
			'file_to_upload' => 'required|file|mimes:xls,xlsx'
		]);

		// upload file as record
		if ($file = $request->file('file_to_upload')) {
			$fileName 		= date("YmdHis") . "-" . $request->file('file_to_upload')->getClientOriginalName();
			// OK. Store File in Storage Private Folder. Auto create folder
			$request->file_to_upload->storeAs('private/'.$subdir.'/', $fileName);
		}

		// process file
		$the_file = $request->file('file_to_upload');

		// delete old records
		DB::table('upload_items')
			->where('status', '<>', InterfaceStatusEnum::UPLOADED->value)
			->delete();

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
			$owner_id		= auth()->user()->id;

			$data = array();
			foreach ($row_range as $row) {
				$data[] = [
					'owner_id'		=> $owner_id,
					'name'			=> $sheet->getCell('A' . $row)->getValue(),
					'code'			=> $sheet->getCell('B' . $row)->getValue(),
					'notes'			=> $sheet->getCell('C' . $row)->getValue(),
					'category'		=> $sheet->getCell('D' . $row)->getValue(),
					'oem'			=> $sheet->getCell('E' . $row)->getValue(),
					'uom'			=> $sheet->getCell('F' . $row)->getValue(),
					'price'			=> $sheet->getCell('G' . $row)->getValue(),
					'gl_type_name'	=> $sheet->getCell('H' . $row)->getValue(),
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

		$request->merge(['status'	=> InterfaceStatusEnum::DRAFT->value ]);

		//$request->validate();
		$request->validate([

		]);

		$uploadItem->update($request->all());

		return redirect()->route('upload-items.index')->with('success', 'Interface items updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(UploadItem $uploadItem)
	{
		//
	}

	public function check()
	{

		$this->authorize('create', UploadItem::class);

		//echo "I AM HERE!";
		$upload_items = UploadItem::where('status', '<>', InterfaceStatusEnum::UPLOADED->value)
				->orderBy('id', 'DESC')
				->get();
		//dd($upload_items);

		// $upload_items = UploadItem::query();
		// if (request('term')) {
		//     $upload_items->where('name', 'Like', '%' . request('term') . '%');
		// }
		// $upload_items= $upload_items->orderBy('id', 'DESC')->paginate(10);
		// dd($upload_items);

		//$os = array("E", "A", "I");

		foreach ($upload_items as $upload_item) {

			//Log::debug('For id='.$upload_item->id);
			try {

				$category = Category::firstWhere('name', $upload_item->category);
				if(is_null($category)) {
					$category_id = '';
				} else {
					$category_id = $category->id;
				}

				$oem = OEM::firstWhere('name', $upload_item->oem);
				if(is_null($oem)) {
					$oem_id = '';
				} else {
					$oem_id = $oem->id;
				}

				$uom = Uom::firstWhere('name', $upload_item->uom);
				if(is_null($uom)) {
					$uom_id = '';
				} else {
					$uom_id = $uom->id;
				}

				$gl_type = GLType::firstWhere('name', $upload_item->gl_type_name);
				if(is_null($gl_type)) {
					$gl_type = '';
				} else {
					$gl_type = $gl_type->gl_type;
				}

				// $category = Category::where('name', $upload_item->category)->firstOrFail();
				// $oem = OEM::where('name', $upload_item->oem)->firstOrFail();
				// $uom = Uom::where('name', $upload_item->uom)->firstOrFail();

				Log::debug('Result => id='.$upload_item->id.' category_id='.$category_id.' oem_id='.$oem_id.' uom_id='.$uom_id.' gl_type='.$gl_type);

				if ($category_id == '' || $oem_id == '' || $uom_id == '' || $gl_type == '') {
					UploadItem::where('id', $upload_item->id)
						->update(['status' => InterfaceStatusEnum::ERROR->value]);
				} else {
					UploadItem::where('id', $upload_item->id)
						->update([
							'category_id'	=> $category_id,
							'oem_id'		=> $oem_id,
							'uom_id'		=> $uom_id,
							'gl_type'		=> $gl_type,
							'status'		=> InterfaceStatusEnum::VALIDATED->value,
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
			//Log::debug('For id='.$upload_item->id);
			//id name notes code category_id oem_id uom_id price stock reorder account_type photo enable created_by created_at updated_by updated_at

			$item = [
				'name'			=> $upload_item->name,
				'code'			=> $upload_item->code,
				'notes'			=> $upload_item->notes,
				'category_id'	=> $upload_item->category_id,
				'oem_id'		=> $upload_item->oem_id,
				'uom_id'		=> $upload_item->uom_id,
				'price'			=> $upload_item->price,
				'gl_type'		=> $upload_item->gl_type,
			];

			Item::create($item); // don't forget to fill $fillable in Model
			UploadItem::where('id', $upload_item->id)
				->update(['status' => InterfaceStatusEnum::UPLOADED->value]);
		}

		return redirect()->route('upload-items.index')->with('success', 'Item uploaded successfully.');

	}

	public function export()
	{
		$data = DB::select("SELECT i.id, u.name owner_name, i.name, i.code, i.notes, i.category, i.oem, i.uom, i.price, i.account_type, i.status
			FROM upload_items i,users u
			WHERE i.owner_id=u.id");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('upload_items', $dataArray);
	}
}
