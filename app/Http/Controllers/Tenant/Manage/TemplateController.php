<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			TemplateController.php
* @brief		This file contains the implementation of the TemplateController
* @path			\App\Http\Controllers\Tenant\Manage
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
namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\Template;
use App\Http\Requests\Tenant\Manage\StoreTemplateRequest;
use App\Http\Requests\Tenant\Manage\UpdateTemplateRequest;


# 1. Models
use App\Models\User;
use App\Models\Tenant\Lookup\Country;
# 2. Enums
use App\Enum\EntityEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
use App\Helpers\FileUpload;
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
use Illuminate\Support\Facades\Log;
use Str;
# 13. FUTURE 

class TemplateController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct(){
	//     $this->middleware('auth');
	// }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$this->authorize('viewAny', Template::class);

		//$templates = Template::latest()->orderBy('id','desc')->paginate(10);

		$templates = Template::query();
		if (request('term')) {
			$templates->where('name', 'Like', '%' . request('term') . '%');
		}

		$templates = $templates->with('user')->orderBy('id', 'DESC')->paginate(10);
		//$templates = Template::latest()->orderBy('id','desc')->paginate(10);

		return view('tenant.manage.templates.index', compact('templates'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Template::class);

		$users = User::getAll();
		$countries = Country::getAll();

		return view('tenant.manage.templates.create', compact('users', 'countries'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreTemplateRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreTemplateRequest $request)
	{

		$this->authorize('create', Template::class);

		if($request->has('my_bool')) {
			//Checkbox checked
			$request->merge(['my_bool' => 1,]);
		} else {
			//Checkbox not checked
			$request->merge([ 'my_bool' => 0,]);
		}

		$request->merge([
			 'code' => Str::upper($request['code']),
		]);

		//dd($request);
		$template = Template::create($request->all());
		// Write to Log
		EventLog::event('tenant.template', $template->id, 'create');


		// Upload File, if any, insert row in attachment table  and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $template->id ]);
			$request->merge(['entity'		=> EntityEnum::TEMPLATE->value ]);
			$attid = FileUpload::upload($request);
		}

		return redirect()->route('templates.index')->with('success', 'Templates created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Template  $template
	 * @return \Illuminate\Http\Response
	 */
	public function show(Template $template)
	{
		$this->authorize('view', $template);
		$entity = EntityEnum::TEMPLATE->value ;
		return view('tenant.manage.templates.show', compact('template', 'entity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Template  $template
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Template $template)
	{

		$this->authorize('update', $template);
		$users = User::getAll();
		$countries = Country::getAll();

		// Write Event Log
		EventLog::event('template', $template->id, 'edit', 'template', $template->name);
		return view('tenant.manage.templates.edit', compact('template', 'users', 'countries'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateTemplateRequest  $request
	 * @param  \App\Models\Template  $template
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateTemplateRequest $request, Template $template)
	{
		$this->authorize('update', $template);

		// check if old value has been change
		if ($request->input('address2') <> $template->address2) {
			EventLog::event('template', $template->id, 'update', 'address2', $template->address2);
		}
		if ($request->input('email') <> $template->email) {
			EventLog::event('template', $template->id, 'update', 'email', $template->email);
		}

		if ($request->input('agent_id') <> $template->agent_id) {

			// Send notification to Assigned Agent
			//$agent = User::where('id', $request->input('agent_id'))->first();
			$agent->notify(new templateAssigned($agent, $template));
			EventLog::event('template', $template->id, 'update', 'agent_id', $template->agent_id);
		}

		// check box
		if($request->has('my_bool')) {
			//Checkbox checked
			$request->merge(['my_bool' => 1]);
		} else {
			//Checkbox not checked
			$request->merge([ 'my_bool' => 0]);
		}

		//$request->validate();
		$request->validate([

		]);
		$template->update($request->all());

		EventLog::event('template', $template->id, 'update', 'name', $template->name);
		return redirect()->route('templates.index')->with('success', 'Template updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Template  $template
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Template $template)
	{

		$this->authorize('delete', $template);

		$template->fill(['enable' => ! $template->enable]);
		$template->update();

		// Write to Log
		EventLog::event('template', $template->id, 'enable', 'status', $template->enable);

		return redirect()->route('templates.index')->with('success', 'Template Status updated successfully');
	}


	public function submit(Template $template)
	{

		$this->authorize('delete', $template);

		// Write to Log
		//EventLog::event('template',$template->id,'enable','status',$template->enable);

		return redirect()->route('templates.show', $template->id)->with('success', 'Template Submitted successfully');
	}

	/**
	*
	* Export selected column to csv format
	*
	*/
	public function export()
	{
		$this->authorize('export', Template::class);

		$data = DB::select("SELECT id, code, name, summary, user_id, address1, address2, city, state, zip, country, email, phone, qty, amount, notes, 
				enable, my_date, my_date_time, my_enum, my_url, logo, avatar, attachment, fbpage, deleted_at, created_by, created_at, updated_by, updated_at 
				FROM templates
				 ORDER BY id
				 ");
		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return Export::csv('templates', $dataArray);
	}


}
