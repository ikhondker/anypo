<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			TicketController.php
* @brief		This file contains the implementation of the TicketController
* @path			\app\Http\Controllers\Landlord
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

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreTicketRequest;
use App\Http\Requests\Landlord\UpdateTicketRequest;

# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
# 13. TODO 


// Models
use App\Models\User;
use App\Models\Landlord\Ticket;

use App\Models\Landlord\Lookup\Dept;

use App\Models\Landlord\Manage\Priority;

// Enums
use App\Enum\UserRoleEnum;
use App\Enum\LandlordTicketStatusEnum;

// Helpers
use App\Helpers\Export;
use App\Helpers\LandlordFileUpload;
use App\Helpers\LandlordEventLog;

// Notification
use Notification;
use App\Notifications\Landlord\TicketCreated;
use App\Notifications\Landlord\TicketAssigned;
use App\Notifications\Landlord\TicketClosed;

// Seeded
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Str;
use DB;

class TicketController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'TICKET';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$tickets = Ticket::query();
		if (request('term')) {
			$tickets->where('title', 'Like', '%' . request('term') . '%');
		}

		switch (auth()->user()->role->value) {
			case UserRoleEnum::ADMIN->value:
				$tickets = $tickets->byAccount()->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$tickets = $tickets->byUser()->orderBy('id', 'DESC')->paginate(10);
				Log::warning("landlord.tickets.index Ignore. Other roles!");
		}

		return view('landlord.tickets.index', compact('tickets'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{

		$this->authorize('viewAll',Ticket::class);

		$tickets = Ticket::orderBy('id', 'DESC')->paginate(10);

		return view('landlord.tickets.all', compact('tickets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create',Ticket::class);

		$depts = Dept::getAll();
		$priorities = Priority::getAll(); 

		return view('landlord.tickets.create', compact('depts', 'priorities'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreTicketRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreTicketRequest $request)
	{
		$this->authorize('create',Ticket::class);
		$request->merge([
			//'ticket_number' => Str::uuid()->toString(),
			'ticket_date'	=> date('Y-m-d H:i:s'),
			'status_code'	=> LandlordTicketStatusEnum::NEW->value,
			'owner_id'		=> auth()->user()->id,
			'account_id'	=> auth()->user()->account_id,
			'ip'			=> $request->ip()
		]);

		// Create Ticket
		$ticket = Ticket::create($request->all());
		// Write to Log
		LandlordEventLog::event('ticket', $ticket->id, 'create');

		// Upload File, if any, insert row in attachment table and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $ticket->id]);
			$request->merge(['entity'		=> static::ENTITY]);
			$attachment_id = LandlordFileUpload::upload($request);

			// update back table with attachment_id
			$ticket->attachment_id = $attachment_id;
			$ticket->save();
		}

		// Send notification to Ticket creator
		$owner = User::where('id', $ticket->owner_id)->first();
		$owner->notify(new TicketCreated($owner, $ticket));

		// Send notification to Support Manager
		$mgr = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		$mgr->notify(new TicketCreated($mgr, $ticket));

		return redirect()->route('tickets.index')->with('success', 'A New Ticket No ' . $ticket->id . ' is created. We will come back to you soon. Thanks.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Ticket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function show(Ticket $ticket)
	{
		$this->authorize('view', $ticket);

		$entity = static::ENTITY;
		return view('landlord.tickets.show', compact('ticket', 'entity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Ticket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Ticket $ticket)
	{
		$this->authorize('update', $ticket);
		return view('landlord.tickets.edit', compact('ticket'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateTicketRequest  $request
	 * @param  \App\Models\Ticket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateTicketRequest $request, Ticket $ticket)
	{
		$this->authorize('update', $ticket);

		//dd($ticket);
		//$request->validate();
		$request->validate([]);

		if ($request->input('dept_id') <> $ticket->dept_id) {
			LandlordEventLog::event('ticket', $ticket->id, 'update', 'dept_id', $ticket->dept_id);
		}
		if ($request->input('priority_id') <> $ticket->priority_id) {
			LandlordEventLog::event('ticket', $ticket->id, 'update', 'priority_id', $ticket->priority_id);
		}

		if ($request->input('agent_id') <> $ticket->agent_id) {

			// Send notification to Assigned Agent
			$agent = User::where('id', $request->input('agent_id'))->first();
			$agent->notify(new TicketAssigned($agent, $ticket));

			LandlordEventLog::event('ticket', $ticket->id, 'update', 'agent_id', $ticket->agent_id);
		}
		//dd($ticket);
		$ticket->update($request->all());

		//return redirect()->route('tickets.show',$ticket->id)->with('success','Ticket updated successfully');
		return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Ticket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Ticket $ticket)
	{
		//
	}

	
	public function assign(Ticket $ticket)
	{

		$this->authorize('assign', $ticket);

		$agents = User::getAllAgent();
		return view('landlord.tickets.assign', compact('ticket', 'agents'));
	}

	public function doAssign(Request $request, Ticket $ticket)
	{
		
		$this->authorize('assign', $ticket);
		$ticket->agent_id	= $request->input('agent_id');
		$ticket->save();
		
		LandlordEventLog::event('ticket', $ticket->id, 'assign', 'agent_id', $ticket->agent_id);

		// Send notification to Assigned Agent
		$agent = User::where('id', $request->input('agent_id'))->first();
		$agent->notify(new TicketAssigned($agent, $ticket));
		
		LandlordEventLog::event('ticket', $ticket->id, 'assign', 'agent_id', $ticket->agent_id);

		return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket #' . $ticket->id . ' assigned to agent and notified.');
	}


	public function close(Ticket $ticket)
	{
		$this->authorize('update',$ticket);

		$ticket->status_code	= LandlordTicketStatusEnum::CLOSED->value;
		$ticket->save();
		LandlordEventLog::event('ticket', $ticket->id, 'update', 'status_code', $ticket->status_code);

		// Send notification to Ticket creator
		$owner = User::where('id', $ticket->owner_id)->first();
		$owner->notify(new TicketClosed($owner, $ticket));

		return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket #' . $ticket->id . ' closed successfully');
	}


	public function export()
	{
		$this->authorize('export', Ticket::class);

		if (auth()->user()->isBackOffice()){
			$data = DB::select("SELECT id, title, content, ticket_date, owner_id, account_id, status_code, created_at
				FROM tickets");
		} else if (auth()->user()->role->value == UserRoleEnum::ADMIN->value){
			$data = DB::select("SELECT id, title, content, ticket_date, owner_id, account_id, status_code, created_at
				FROM tickets
				WHERE account_id=".auth()->user()->account_id);
		} else {
			$data = DB::select("SELECT id, title, content, ticket_date, owner_id, account_id, status_code, created_at
			FROM tickets
			WHERE  owner_id =".auth()->user()->id);
		}

		//Log::debug('landlord.ticket.export Role= '. auth()->user()->role->value);
		//$data = DB::select("SELECT id, name, email, cell, role, enable FROM users");

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('tickets', $dataArray);

	}
}
