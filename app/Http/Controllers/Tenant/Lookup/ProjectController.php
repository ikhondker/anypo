<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Project;
use App\Http\Requests\Tenant\Lookup\StoreProjectRequest;
use App\Http\Requests\Tenant\Lookup\UpdateProjectRequest;

# Models
use App\Models\User;
use App\Models\Tenant\Admin\Attachment;
# Enums
use App\Enum\EntityEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Foundation\Http\FormRequest;

# Exceptions
# Events


class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$projects = Project::query();
		if (request('term')) {
			$projects->where('name', 'Like', '%' . request('term') . '%');
		}
		$projects = $projects->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.projects.index', compact('projects'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Project::class);
		$pms = User::primary()->get();

		return view('tenant.lookup.projects.create', compact('pms'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreProjectRequest $request)
	{
		$this->authorize('create', Project::class);

		if($request->has('budget_control')) {
			//Checkbox checked
			$request->merge(['budget_control' =>  1,]);
		} else {
			//Checkbox not checked
			$request->merge([ 'budget_control' =>  0,]);
		}

		$project = Project::create($request->all());
		// Write to Log
		EventLog::event('project', $project->id, 'create');

		return redirect()->route('projects.index')->with('success', 'Project created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Project $project)
	{
		$this->authorize('view', $project);

		return view('tenant.lookup.projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Project $project)
	{
		$this->authorize('update', $project);

		$pms = User::primary()->get();
		return view('tenant.lookup.projects.edit', compact('project', 'pms'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProjectRequest $request, Project $project)
	{
		$this->authorize('update', $project);

		// check box
		if($request->has('budget_control')) {
			//Checkbox checked
			$request->merge(['budget_control' =>  1]);
		} else {
			//Checkbox not checked
			$request->merge(['budget_control' =>  0]);
		}

		//$request->validate();
		$request->validate([

		]);
		$project->update($request->all());

		// Write to Log
		EventLog::event('project', $project->id, 'update', 'name', $project->name);
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

	public function export()
	{
		$this->authorize('export', Project::class);
		$data = DB::select("SELECT id, name, u.name pm_name, start_date, end_date, budget_control, amount, amount_pr_booked, amount_pr_issued, amount_po_booked, amount_po_issued, amount_grs, amount_payment, notes, 
			IF(enable, 'Yes', 'No') as Enable 
			FROM projects p, users u
			WHERE p.pm_id=u.id");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('projects', $dataArray);
	}

	// add attachments
	public function attach(FormRequest $request)
	{
		//$this->authorize('create', Budget::class);
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_project_id') ]);
			$request->merge(['entity'		=> EntityEnum::PROJECT->value ]);
			$attid = FileUpload::upload($request);
		}
		return redirect()->route('projects.show', $request->input('attach_project_id'))->with('success', 'File Uploaded successfully.');
	}

	public function detach(Project $project)
	{
		//$this->authorize('view', $pr);

		$project = Project::where('id', $project->id)->get()->firstOrFail();
		$attachments = Attachment::where('entity', EntityEnum::PROJECT->value)->where('article_id', $project->id)->get()->all();
		return view('tenant.lookup.projects.detach', compact('project', 'attachments'));
	}
}
