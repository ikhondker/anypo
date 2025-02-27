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
use App\Models\User;
use App\Models\Landlord\Ticket;

use App\Models\Landlord\Lookup\Dept;
use App\Models\Landlord\Lookup\Tag;
use App\Models\Landlord\Manage\TicketTag;

use App\Models\Landlord\Manage\Priority;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\Landlord\TicketStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\Landlord\FileUpload;
use App\Helpers\EventLog;

# 4. Notifications
use Notification;
use App\Notifications\Landlord\TicketCreated;
use App\Notifications\Landlord\TicketAssigned;
use App\Notifications\Landlord\TicketClosed;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Str;
use DB;
# 13. FUTURE

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
			$tickets->where('title', 'Like', '%' . request('term') . '%')
			->orWhere('id', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::ADMIN->value:
				$tickets = $tickets->with('owner')->with('dept')->with('priority')->with('status')->byAccount()->orderBy('id', 'DESC')->paginate(20);
				break;
			default:
				$tickets = $tickets->with('owner')->with('dept')->with('priority')->with('status')->byUser()->orderBy('id', 'DESC')->paginate(20);
		}
		return view('landlord.tickets.index', compact('tickets'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create',Ticket::class);

		$owners		= User::LandlordAllEnable()->get();
		$depts 		= Dept::getAll();
		$priorities = Priority::getAll();

		return view('landlord.tickets.create', compact('depts', 'priorities','owners'));
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

		// if support create a Ticke on behalf of a User
		if ( auth()->user()->isBackend() ){
			$owner 		= User::where('id', $request->input('owner_id'))->first();
			$owner_id	= $owner->id;
			$account_id	= $owner->account_id;
		} else {
			$owner_id		= auth()->user()->id;
			$account_id	= auth()->user()->account_id;
		}
		Log::debug('landlord.TicketController.store $request->input(owner_id) = ' . $request->input('owner_id'));
		Log::debug('landlord.TicketController.store isBackend= ' . auth()->user()->isBackend());
		Log::debug('landlord.TicketController.store owner_id= ' . $owner_id);
		Log::debug('landlord.TicketController.store account_id= ' . $account_id);

		$request->merge([
			//'ticket_number' => Str::uuid()->toString(),
			'ticket_date'		=> date('Y-m-d H:i:s'),
			'status_code'		=> TicketStatusEnum::NEW->value,
			'owner_id'			=> $owner_id,
			'account_id'		=> $account_id,
			'dept_id'			=> config('bo.DEFAULT_DEPT_ID'),
			'priority_id'		=> config('bo.DEFAULT_PRIORITY_ID'),
			'category_id'		=> config('bo.DEFAULT_CATEGORY_ID'),
			'last_message_at'	=> date('Y-m-d H:i:s'),
			'ip'				=> $request->ip()
		]);

		// Create Ticket
		$ticket = Ticket::create($request->all());

		// Write to Log
		EventLog::event('ticket', $ticket->id, 'create');

		// Upload File, if any, insert row in attachment table and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $ticket->id]);
			$request->merge(['entity'		=> static::ENTITY]);
			$attachment_id = FileUpload::aws($request);

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

		if ( auth()->user()->isBackend() ){
			return redirect()->route('tickets.all')->with('success', 'A New Ticket #' . $ticket->id . ' is created. We will come back to you soon. Thanks.');
		} else {
			return redirect()->route('tickets.index')->with('success', 'A New Ticket #' . $ticket->id . ' is created. We will come back to you soon. Thanks.');
		}


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
			EventLog::event('ticket', $ticket->id, 'update', 'dept_id', $ticket->dept_id);
		}
		if ($request->input('priority_id') <> $ticket->priority_id) {
			EventLog::event('ticket', $ticket->id, 'update', 'priority_id', $ticket->priority_id);
		}

		if ($request->input('agent_id') <> $ticket->agent_id) {

			// Send notification to Assigned Agent
			$agent = User::where('id', $request->input('agent_id'))->first();
			$agent->notify(new TicketAssigned($agent, $ticket));

			EventLog::event('ticket', $ticket->id, 'update', 'agent_id', $ticket->agent_id);
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


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all(Request $request)
	{
		$this->authorize('viewAny', Ticket::class);

		$tickets = Ticket::with('owner')->with('dept')->with('priority')->with('status');

		if (request('term')) {
			$tickets->where('title', 'Like', '%' . request('term') . '%')
			->orWhere('id', 'Like', '%' . request('term') . '%');
		}

		if ($request->has('status')) {
			$tickets->where('status_code', $request->query('status'));
		}

		$tickets = $tickets->orderBy('id', 'DESC')->paginate(20);

		return view('landlord.tickets.all', compact('tickets'));

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

		$ticket->agent_id		= $request->input('agent_id');
		$ticket->status_code	= TicketStatusEnum::ASSIGNED->value;
		$ticket->save();

		EventLog::event('ticket', $ticket->id, 'assign', 'agent_id', $ticket->agent_id);

		// Send notification to Assigned Agent
		$agent = User::where('id', $request->input('agent_id'))->first();
		$agent->notify(new TicketAssigned($agent, $ticket));

		EventLog::event('ticket', $ticket->id, 'assign', 'agent_id', $ticket->agent_id);

		return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket #' . $ticket->id . ' assigned to agent and notified.');
	}

	public function tags(Ticket $ticket)
	{
		$this->authorize('addTag', $ticket);
		$tags		= Tag::primary()->get();
		return view('landlord.tickets.tags', compact('ticket','tags'));
	}

	public function addTag(Request $request, Ticket $ticket)
	{

		$this->authorize('addTag', $ticket);

		Log::debug('landlord.TicketController.addTag !! ticket_id= ' . $ticket->id);
		Log::debug('landlord.TicketController.addTag request ticket_id= ' . $request->input('ticket_id'));
		Log::debug('landlord.TicketController.addTag request tag_id= ' . $request->input('tag_id'));

		// check if topic is already added
		$count		= TicketTag::where('ticket_id',$request->input('ticket_id') )->where('tag_id',$request->input('tag_id') )->count();
		Log::debug('landlord.TicketController.addTag count= ' . $count);
		if ($count <> 0){
			throw ValidationException::withMessages(['tag_id' => 'This Tag Already added to this Ticket']);
		}
		// create ticketTag row
		$ticketTag				= new TicketTag;
		$ticketTag->ticket_id		= $request->input('ticket_id');
		$ticketTag->tag_id		= $request->input('tag_id');
		$ticketTag->save();

		//$tags		= Tag::primary()->get();
		//return view('landlord.tickets.tags', compact('ticket','tags'));

		// again show tags
		$tags		= Tag::primary()->get();
		return view('landlord.tickets.tags', compact('ticket','tags'));

		//return redirect()->route('tickets.show', $ticket->id)->with('success', 'Tag added.');
	}


	public function close(Ticket $ticket)
	{
		$this->authorize('close', $ticket);

		$ticket->status_code	= TicketStatusEnum::CLOSED->value;
		$ticket->closed	= true;
		$ticket->closed_at	= Now();

		$ticket->save();
		EventLog::event('ticket', $ticket->id, 'update', 'status_code', $ticket->status_code);

		// Send notification to Ticket creator
		$owner = User::where('id', $ticket->owner_id)->first();
		$owner->notify(new TicketClosed($owner, $ticket));

		return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket #' . $ticket->id . ' closed successfully');
	}


	public function export()
	{
		$this->authorize('export', Ticket::class);

		if (auth()->user()->isBackend()){
			$data = DB::select("
				SELECT t.id, t.title subject, t.content, t.ticket_date, u.name owner, a.name account, t.status_code, t.created_at
				FROM tickets as t
				INNER JOIN users as u
				ON t.owner_id=u.id
				LEFT JOIN accounts as a
				ON t.account_id=a.id
				");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("
				SELECT t.id, t.title subject, t.content, t.ticket_date, u.name owner, a.name account, t.status_code, t.created_at
				FROM tickets as t
				INNER JOIN users as u
				ON t.owner_id=u.id
				LEFT JOIN accounts as a
				ON t.account_id=a.id
				WHERE t.account_id = ".auth()->user()->account_id
				);
		} else {
			$data = DB::select("
				SELECT t.id, t.title subject, t.content, t.ticket_date, u.name owner, a.name account, t.status_code, t.created_at
				FROM tickets as t
				INNER JOIN users as u
				ON t.owner_id=u.id
				LEFT JOIN accounts as a
				ON t.account_id=a.id
				WHERE t.owner_id = ".auth()->user()->id
				);
		}

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('tickets', $dataArray);

	}
}
