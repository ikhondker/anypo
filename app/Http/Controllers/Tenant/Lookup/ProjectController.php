<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ProjectController.php
* @brief		This file contains the implementation of the ProjectController
* @path			\App\Http\Controllers\Tenant
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


use App\Models\Tenant\Lookup\Project;
use App\Http\Requests\Tenant\Lookup\StoreProjectRequest;
use App\Http\Requests\Tenant\Lookup\UpdateProjectRequest;

# 1. Models
use App\Models\User;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Attachment;

# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
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
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
# 13. FUTURE
# 1. Dashboard chart
# 2. Project Actions
# 3. code enable /visible

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Project::class);

		$projects = Project::query();
		if (request('term')) {
			$projects->where('name', 'Like', '%' . request('term') . '%');
		}
		$projects = $projects->with("pm")->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.lookup.projects.index', compact('projects'));
		// if ( auth()->user()->role->value == UserRoleEnum::USER->value) {
		// 	return view('tenant.lookup.projects.index-basic', compact('projects'));
		// } else {
		// }

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Project::class);
		$pms = User::Tenant()->get();
		$depts = Dept::primary()->get();

		return view('tenant.lookup.projects.create', compact('pms'.'depts'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreProjectRequest $request)
	{
		$this->authorize('create', Project::class);

		$request->merge([
			'code' 			=> Str::upper($request['code']),
		]);


		$project = Project::create($request->all());
		// Write to Log
		EventLog::event('project', $project->id, 'create');

		// Upload File
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $project->id ]);
			$request->merge(['entity'		=> EntityEnum::PROJECT->value ]);
			$attid = FileUpload::aws($request);
		}

		return redirect()->route('projects.index')->with('success', 'Project created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Project $project)
	{
		$this->authorize('view', $project);

		// if ( auth()->user()->role->value == UserRoleEnum::USER->value) {
		// 	return view('tenant.lookup.projects.show-basic', compact('project'));
		// } else {
			return view('tenant.lookup.projects.show', compact('project'));
		// }
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Project $project)
	{
		$this->authorize('update', $project);

		$pms = User::Tenant()->get();
		$depts = Dept::primary()->get();
		return view('tenant.lookup.projects.edit', compact('project', 'pms','depts'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProjectRequest $request, Project $project)
	{
		$this->authorize('update', $project);

		$request->merge([
			'code' 			=> Str::upper($request['code']),
		]);

		//$request->validate();
		$request->validate([

		]);

		// Write to Log
		EventLog::event('project', $project->id, 'update', 'name', $project->name);
		$project->update($request->all());


		return redirect()->route('projects.index')->with('success', 'Project updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Project $project)
	{
		$this->authorize('delete', $project);

		$project->fill(['closed' => !$project->closed]);
		$project->update();

		// Write to Log
		EventLog::event('project', $project->id, 'status', 'closed', $project->closed);

		return redirect()->route('projects.index')->with('success', 'Project status Updated successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function timestamp(Project $project)
	{
		$this->authorize('view', $project);

		return view('tenant.lookup.projects.timestamp', compact('project'));
	}


	/**
	 * Display the specified resource.
	 */
	public function budget(Project $project)
	{
		$this->authorize('view', $project);

		return view('tenant.lookup.projects.budget', compact('project'));
	}

	/**
	 * Display the specified resource.
	 */
	public function pbu(Project $project)
	{
		$this->authorize('view', $project);

		return view('tenant.lookup.projects.pbu', compact('project'));
	}


	public function export()
	{

		$this->authorize('export', Project::class);

		$fileName = 'export-projects-' . date('Ymd') . '.xls';
		$projects = Project::with('pm')->with('dept')->with('user_created_by')->with('user_updated_by');

		// HoD sees only dept lines
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$projects = $projects->where('dept_id', auth()->user()->dept_id);
		}

		$projects = $projects->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'ID#');
		$sheet->setCellValue('B1', 'Name');
		$sheet->setCellValue('C1', 'Manager');
		$sheet->setCellValue('D1', 'Start Date');
		$sheet->setCellValue('E1', 'End Date');
		$sheet->setCellValue('F1', 'Department');
		$sheet->setCellValue('G1', 'Notes');
		$sheet->setCellValue('H1', 'Closed');

		if ( auth()->user()->isSuperior()) {
			$sheet->setCellValue('I1', 'Budget');
			$sheet->setCellValue('J1', 'amount_pr_booked');
			$sheet->setCellValue('K1', 'amount_pr');
			$sheet->setCellValue('L1', 'amount_po_booked');
			$sheet->setCellValue('M1', 'amount_po');
			$sheet->setCellValue('N1', 'amount_grs');
			$sheet->setCellValue('O1', 'amount_payment');
		}


		// $sheet->setCellValue('V1', 'Created By');
		// $sheet->setCellValue('W1', 'Created At');
		// $sheet->setCellValue('X1', 'Updated By');
		// $sheet->setCellValue('Y1', 'Updated At');

		$rows = 2;
		foreach($projects as $project){
			$sheet->setCellValue('A' . $rows, $project->id);
			$sheet->setCellValue('B' . $rows, $project->name);
			$sheet->setCellValue('C' . $rows, $project->pm->name);
			$sheet->setCellValue('D' . $rows, $project->start_date);
			$sheet->setCellValue('E' . $rows, $project->end_date);
			$sheet->setCellValue('F' . $rows, $project->dept->name);
			$sheet->setCellValue('G' . $rows, $project->notes);
			$sheet->setCellValue('H' . $rows, ($project->closed ? 'Yes' : 'No'));

			if ( auth()->user()->isSuperior()) {
				$sheet->setCellValue('I' . $rows, $project->amount);
				$sheet->setCellValue('J' . $rows, $project->amount_pr_booked);
				$sheet->setCellValue('K' . $rows, $project->amount_pr);
				$sheet->setCellValue('L' . $rows, $project->amount_po_booked);
				$sheet->setCellValue('M' . $rows, $project->amount_po);
				$sheet->setCellValue('N' . $rows, $project->amount_grs);
				$sheet->setCellValue('O' . $rows, $project->amount_payment);
			}
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

	// add attachments
	public function attach(FormRequest $request)
	{
		$this->authorize('create', Project::class);

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_project_id') ]);
			$request->merge(['entity'		=> EntityEnum::PROJECT->value ]);
			$attid = FileUpload::aws($request);
		}

		return redirect()->route('projects.show', $request->input('attach_project_id'))->with('success', 'File Uploaded successfully.');
	}

	public function attachments(Project $project)
	{
		$this->authorize('view', $project);

		//$project = Project::where('id', $project->id)->get()->firstOrFail();

		//$attachments = Attachment::with('owner')->where('entity', EntityEnum::PROJECT->value)->where('article_id', $project->id)->paginate(10);
		return view('tenant.lookup.projects.attachments', compact('project'));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function spends()
	{
		$this->authorize('spends',Project::class);

		$projects = Project::query();
		if (request('term')) {
			$projects->where('name', 'Like', '%' . request('term') . '%');
		}

        // HoD sees only his projects
		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$projects = $projects->where('dept_id', auth()->user()->dept_id);
		}

        $projects = $projects->orderBy(DB::raw("(amount_pr_booked + amount_pr + amount_po_booked + amount_po)"), 'DESC')->paginate(10);

		return view('tenant.lookup.projects.spends', compact('projects'));
	}

		/**
	 * Display the specified resource.
	 */
	public function po(Project $project)
	{
		$this->authorize('view', $project);

		return view('tenant.lookup.projects.po', compact('project'));
	}

}
