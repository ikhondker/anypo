<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			SupplierController.php
* @brief		This file contains the implementation of the SupplierController
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


use App\Models\Tenant\Lookup\Supplier;
use App\Http\Requests\Tenant\Lookup\StoreSupplierRequest;
use App\Http\Requests\Tenant\Lookup\UpdateSupplierRequest;

# 1. Models
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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

# 12. FUTURE


class SupplierController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Supplier::class);

		$suppliers = Supplier::query();
		if (request('term')) {
			$suppliers->where('name', 'Like', '%' . request('term') . '%');
		}
		$suppliers = $suppliers->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.suppliers.index', compact('suppliers'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Supplier::class);
		return view('tenant.lookup.suppliers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreSupplierRequest $request)
	{
		$this->authorize('create', Supplier::class);

		$request->merge([
			'state' 			=> Str::upper($request['state']),
		]);

		$supplier = Supplier::create($request->all());
		// Write to Log
		EventLog::event('supplier', $supplier->id, 'create');

		// Upload File
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $supplier->id ]);
			$request->merge(['entity'		=> EntityEnum::SUPPLIER->value ]);
			$attid = FileUpload::aws($request);
		}


		return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Supplier $supplier)
	{
		$this->authorize('view', $supplier);
		return view('tenant.lookup.suppliers.show', compact('supplier'));
	}




	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Supplier $supplier)
	{
		$this->authorize('update', $supplier);
		return view('tenant.lookup.suppliers.edit', compact('supplier'));
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateSupplierRequest $request, Supplier $supplier)
	{
		$this->authorize('update', $supplier);
		$request->merge([
			'state' 			=> Str::upper($request['state']),
		]);

		// $request->validate();
		$request->validate([

		]);

		// Write to Log
		EventLog::event('supplier', $supplier->id, 'update', 'name', $supplier->name);
		$supplier->update($request->all());


		return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Supplier $supplier)
	{
		$this->authorize('delete', $supplier);

		$supplier->fill(['enable' => !$supplier->enable]);
		$supplier->update();

		// Write to Log
		EventLog::event('supplier', $supplier->id, 'status', 'enable', $supplier->enable);

		return redirect()->route('suppliers.index')->with('success', 'Supplier status Updated successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function timestamp(Supplier $supplier)
	{
		$this->authorize('view', $supplier);

		return view('tenant.lookup.suppliers.timestamp', compact('supplier'));
	}


	public function attachments(Supplier $supplier)
	{
		$this->authorize('view', $supplier);
		$supplier = Supplier::where('id', $supplier->id)->get()->firstOrFail();
		return view('tenant.lookup.suppliers.attachments', compact('supplier'));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function spends()
	{
		$this->authorize('spends',Supplier::class);

		$suppliers = Supplier::query();
		if (request('term')) {
			$suppliers->where('name', 'Like', '%' . request('term') . '%');
		}
		$suppliers = $suppliers->orderBy( DB::raw("(amount_pr_booked + amount_pr + amount_po_booked + amount_po)") , 'DESC')->paginate(10);

		return view('tenant.lookup.suppliers.spends', compact('suppliers'));
	}

	/**
	 * Display the specified resource.
	 */
	public function po(Supplier $supplier)
	{
		$this->authorize('view', $supplier);
		return view('tenant.lookup.suppliers.po', compact('supplier'));
	}


	public function export()
	{
		// TODO change from csv to xls
		$this->authorize('export', Supplier::class);


		$fileName = 'export-suppliers-' . date('Ymd') . '.xls';
		$suppliers = Supplier::with('user_created_by')->with('user_updated_by');


		$suppliers = $suppliers->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

	   // $data = DB::select("SELECT id, name, address1, address2, contact_person, cell, city, zip, state, country, website, email, IF(enable, 'Yes', 'No') as Enable

		$sheet->setCellValue('A1', 'ID#');
		$sheet->setCellValue('B1', 'Name');
		$sheet->setCellValue('C1', 'address1');
		$sheet->setCellValue('D1', 'address2');
		$sheet->setCellValue('E1', 'contact_person');
		$sheet->setCellValue('F1', 'cell');
		$sheet->setCellValue('G1', 'city');
		$sheet->setCellValue('H1', 'zip');
		$sheet->setCellValue('I1', 'state');
		$sheet->setCellValue('J1', 'country');
		$sheet->setCellValue('K1', 'website');
		$sheet->setCellValue('L1', 'email');
		$sheet->setCellValue('M1', 'Active');

		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($suppliers as $supplier){
			$sheet->setCellValue('A' . $rows, $supplier->id);
			$sheet->setCellValue('B' . $rows, $supplier->name);
			$sheet->setCellValue('C' . $rows, $supplier->address1);
			$sheet->setCellValue('D' . $rows, $supplier->address2);
			$sheet->setCellValue('E' . $rows, $supplier->contact_person);
			$sheet->setCellValue('F' . $rows, $supplier->cell);
			$sheet->setCellValue('G' . $rows, $supplier->city);
			$sheet->setCellValue('H' . $rows, $supplier->zip);

			$sheet->setCellValue('I' . $rows, $supplier->state);
			$sheet->setCellValue('J' . $rows, $supplier->country);
			$sheet->setCellValue('K' . $rows, $supplier->website);
			$sheet->setCellValue('L' . $rows, $supplier->email);
			$sheet->setCellValue('M' . $rows, ($supplier->enable ? 'Yes' : 'No'));

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
}
