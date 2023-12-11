<?php

namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\Template;
use App\Http\Requests\Tenant\Manage\StoreTemplateRequest;
use App\Http\Requests\Tenant\Manage\UpdateTemplateRequest;


//
// Version 1.2 2-feb-23 Project: bo04
//

# Models
use App\Models\User;
use App\Models\Tenant\Lookup\Country;
# Enums
use App\Enum\EntityEnum;
# Helpers
use App\Helpers\FileUpload;
use App\Helpers\EventLog;
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use Illuminate\Support\Facades\Log;
use DB;
use Str;

# Exceptions
# Events

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

        $templates = $templates->orderBy('id', 'DESC')->paginate(10);
        //$templates = Template::latest()->orderBy('id','desc')->paginate(10);

        return view('tenant.manage.templates.index', compact('templates'))->with('i', (request()->input('page', 1) - 1) * 10);
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
            $request->merge(['my_bool' =>  1,]);
        } else {
            //Checkbox not checked
            $request->merge([ 'my_bool' =>  0,]);
        }

        //$this->authorize('create',Entity::class);
        $request->merge([
             'code' =>  Str::upper($request['code']),
        ]);

        //dd($request);
        $template = Template::create($request->all());
        // Write to Log
        EventLog::event('tenant.template', $template->id, 'create');


        // Upload File, if any, insert row in attachment table  and get attachments id
        if ($file = $request->file('file_to_upload')) {
            $request->merge(['article_id'    => $template->id ]);
            $request->merge(['entity'       => EntityEnum::TEMPLATE->value ]);
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

            // Send notification to Assigned Agent            $agent = User::where('id', $request->input('agent_id'))->first();
            $agent->notify(new templateAssigned($agent, $template));
            EventLog::event('template', $template->id, 'update', 'agent_id', $template->agent_id);
        }

        // check box
        if($request->has('my_bool')) {
            //Checkbox checked
            $request->merge(['my_bool' =>  1]);
        } else {
            //Checkbox not checked
            $request->merge([ 'my_bool' =>  0]);
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

        //$this->authorize('delete', $template);

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
