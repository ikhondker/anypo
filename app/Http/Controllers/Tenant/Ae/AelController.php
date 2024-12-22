<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AelController.php
* @brief		This file contains the implementation of the AelController
* @path			\app\Http\Controllers\Tenant\Ae
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

namespace App\Http\Controllers\Tenant\Ae;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Ae\Ael;
use App\Http\Requests\Tenant\Ae\StoreAelRequest;
use App\Http\Requests\Tenant\Ae\UpdateAelRequest;

# 1. Models
use App\Models\Tenant\Admin\Setup;

# 2. Enums
use App\Enum\Tenant\EntityEnum;

# 3. Helpers
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Exception;
# 13. FUTURE
use Illuminate\Http\Request;

class AelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Ael::class);
		$aels = Ael::query();

		Log::debug('tenant.ae.ael.index Value of action = ' . request('action'));

		// TODO CHECK
		if (request('start_date') && tenant()) {
			$start_date = 	request('start_date');
			$end_date	=	request('end_date');
			Log::debug('tenant.ae.ael.index Value of start_date = ' . request('start_date'));
			Log::debug('tenant.ae.ael.index Value of end_date = ' . request('end_date'));
		}

		switch (request('action')) {
			case 'search':
				// Search model
				$aels->whereBetween('accounting_date', [$start_date, $end_date ]);
				break;
			case 'export':
				// Export model

				$fileName = 'export-aels-' . date('Ymd') . '.xls';
				$aels = Ael::with('aeh')->with('user_created_by')->with('user_updated_by');
				$aels->whereBetween('accounting_date', [$start_date, $end_date ]);
				$aels = $aels->get();

				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();

				$sheet->setCellValue('A1', 'AEL#');
				$sheet->setCellValue('B1', 'Source');
				$sheet->setCellValue('C1', 'Entity');
				$sheet->setCellValue('D1', 'Event');
				$sheet->setCellValue('E1', 'Line Num');
				$sheet->setCellValue('F1', 'Date');
				$sheet->setCellValue('G1', 'AC Code');
				$sheet->setCellValue('H1', 'Line Desc');
				$sheet->setCellValue('I1', 'Currency');
				$sheet->setCellValue('J1', 'Dr');
				$sheet->setCellValue('K1', 'Cr');
				$sheet->setCellValue('L1', 'PO#');
				$sheet->setCellValue('M1', 'Reference');
				// $sheet->setCellValue('R1', 'Created By');
				// $sheet->setCellValue('S1', 'Created At');
				// $sheet->setCellValue('T1', 'Updated By');
				// $sheet->setCellValue('U1', 'Updated At');

				$rows = 2;
				foreach($aels as $ael){
					$sheet->setCellValue('A' . $rows, $ael->id);
					$sheet->setCellValue('B' . $rows, $ael->aeh->source_app);
					$sheet->setCellValue('C' . $rows, $ael->aeh->source_entity->value);
					$sheet->setCellValue('D' . $rows, $ael->aeh->event->value);
					$sheet->setCellValue('E' . $rows, $ael->line_num);
					$sheet->setCellValue('F' . $rows, $ael->accounting_date);
					$sheet->setCellValue('G' . $rows, $ael->ac_code);
					$sheet->setCellValue('H' . $rows, $ael->line_description);
					$sheet->setCellValue('I' . $rows, $ael->fc_currency);
					$sheet->setCellValue('J' . $rows, $ael->fc_dr_amount);
					$sheet->setCellValue('K' . $rows, $ael->fc_cr_amount);
					$sheet->setCellValue('L' . $rows, $ael->aeh->po_i);
					$sheet->setCellValue('M' . $rows, $ael->reference_no);
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

				break;
		}

		// if (request('term')) {
		// 	$aels->where('po_id', 'Like', '%' . request('term') . '%');
		// }

		$aels = $aels->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.ae.aels.index', compact('aels'));
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
	public function store(StoreAelRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Ael $ael)
	{
		//abort(403);
		$this->authorize('view', $ael);
		return view('tenant.ae.aels.show', compact('ael'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Ael $ael)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAelRequest $request, Ael $ael)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Ael $ael)
	{
		abort(403);
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function manual()
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function manualAel()
	{
		abort(403);
	}


	public function exportForPo($id)
	{
		$this->authorize('export', Ael::class);

		$data = DB::select("
			SELECT id, source, entity, event, accounting_date, ac_code, line_description,
			fc_currency currency, fc_dr_amount dr_amount, fc_cr_amount cr_amount,
			po_id, reference
			FROM aels
			WHERE po_id = ".$id."");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('aels-po-'.$id, $dataArray);
	}
}
