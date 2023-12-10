<?php

namespace App\Http\Controllers\Tenant\Support;

use App\Http\Controllers\Controller;

//use App\Models\Tenant\Support\Ticket;
use App\Http\Requests\Tenant\Support\StoreTicketRequest;
use App\Http\Requests\Tenant\Support\UpdateTicketRequest;

use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
	   // $this->authorize('create',Ticket::class);

		//$depts = Dept::getAll();
		//$priorities = Priority::getAll(); 

		//return view('tenant.support.tickets.create', compact('depts', 'priorities'));
		return view('tenant.support.tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTicketRequest $request)
	{
		//$this->authorize('create',Ticket::class);
		$request->merge([
			//'ticket_number' => Str::uuid()->toString(),
			'ticket_date'	=> date('Y-m-d H:i:s'),
			//'status_code'	=> LandlordTicketStatusEnum::NEW->value,
			'owner_id'		=> auth()->user()->id,
			//'account_id'	=> auth()->user()->account_id,
			//'ip'			=> Request::ip()
		]);
		//A++ https://laracasts.com/discuss/channels/laravel/variables-is-not-passed-inside-function

		//https://stackoverflow.com/questions/67902063/stancl-tenancy-how-to-fetch-data-from-tenant-db-globally
		//Stancl\Tenancy\Database\Concerns\CentralConnection
		
		$tenant_id= tenant('id');

		$id=1002;
		$name=auth()->user()->name;
		$email=auth()->user()->email;

		$name='User 4 by Tenant';
		$email='user4@example.com';
		
		// 
		$landlordUser = tenancy()->central(function ($tenant)  use ($tenant_id, $name, $email) {
						
						Log::debug("tenant_id= ".$tenant_id);
						$account = \App\Models\Landlord\Account::where('site', $tenant_id)->first();

						
						Log::debug("email= ".$email);
						$user = \App\Models\User::where('email', $email)->first();
						if(is_null($user)) {
							Log::debug("create user for= ".$email);   
							$user = \App\Models\User::create([
								'name' 		=> $name,
								'email' 	=> $email,
								'account_id' 	=> $account->id,
								'password' 	=> \Illuminate\Support\Facades\Hash::make($tenant->initial_password),
							]);
							Log::debug('Landlord user Created id=' . $user->id);
						} else {
							Log::debug("user found = ".$email);
						}
						//return \App\Models\User::find(1001);
						return $user;
					});
		
		//dd($landlordUser);

		$landlordUserId=$landlordUser->id;

		$aa = tenancy()->central(function ($tenant)  use ($landlordUserId) {
			Log::debug("landlordUserId= ".$landlordUserId);
			// must get
			$user = \App\Models\User::where('id', $landlordUserId)->first();
			
				Log::debug("first must get = ".$user->email);
				 $ticket = \App\Models\Landlord\Ticket::create([
				    'title' 		=> 'from tenant',
				    'content' 		=> 'from tenant',
				    'owner_id' 		=> $user->id,
					'account_id' 	=> $user->account_id,
					'dept_id' 		=> 1001,
					'priority_id' 	=> 1001,
					'category_id' 	=> 1001,
				]);
				Log::debug('Ticket created =' . $ticket->id);

				// create admin user in newly created tenant
			

			return \App\Models\User::find($landlordUserId);
		});
		dd($aa);

		// // Create Ticket
		// $ticket = Ticket::create($request->all());
		// // Write to Log
		// LandlordEventLog::event('ticket', $ticket->id, 'create');

		// // Upload File, if any, insert row in attachment table  and get attachments id
		// if ($file = $request->file('file_to_upload')) {
		// 	$request->merge(['article_id'	=> $ticket->id]);
		// 	$request->merge(['entity'		=> static::ENTITY]);
		// 	$attachment_id = LandlordFileUpload::upload($request);

		// 	// update back table with attachment_id
		// 	$ticket->attachment_id = $attachment_id;
		// 	$ticket->save();
		// }

		// // Send notification to Ticket creator
		// $owner = User::where('id', $ticket->owner_id)->first();
		// $owner->notify(new TicketCreated($owner, $ticket));

		// // Send notification to Support Manager
		// $mgr = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		// $mgr->notify(new TicketCreated($mgr, $ticket));

		return redirect()->route('tickets.index')->with('success', 'Ticket #' . $ticket->id . ' created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Ticket $ticket)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Ticket $ticket)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTicketRequest $request, Ticket $ticket)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Ticket $ticket)
	{
		//
	}
}
