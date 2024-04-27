<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			TicketController.php
* @brief		This file contains the implementation of the TicketController
* @path			\App\Http\Controllers\Tenant\Support
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
namespace App\Http\Controllers\Tenant\Support;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Support\Ticket;
use App\Http\Requests\Tenant\Support\StoreTicketRequest;
use App\Http\Requests\Tenant\Support\UpdateTicketRequest;

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
use DB;
use Illuminate\Support\Facades\Log;
# 13. FUTURE 


class TicketController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY = 'TICKET';

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
		
		$this->authorize('create',Ticket::class);
		//$depts = Dept::getAll();
		//$priorities = Priority::getAll(); 

		return view('tenant.support.tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTicketRequest $request)
	{
		$this->authorize('create',Ticket::class);
		
		// $request->merge([
		// 	//'ticket_number' => Str::uuid()->toString(),
		// 	'ticket_date'	=> date('Y-m-d H:i:s'),
		// 	//'status_code'	=> LandlordTicketStatusEnum::NEW->value,
		// 	'owner_id'		=> auth()->user()->id,
		// 	//'account_id'	=> auth()->user()->account_id,
		// 	//'ip'			=> Request::ip()
		// ]);
		//A++ https://laracasts.com/discuss/channels/laravel/variables-is-not-passed-inside-function

		//https://stackoverflow.com/questions/67902063/stancl-tenancy-how-to-fetch-data-from-tenant-db-globally
		//Stancl\Tenancy\Database\Concerns\CentralConnection
		
		$tenant_id= tenant('id');
		$name=auth()->user()->name;
		$email=auth()->user()->email;
		$cell=auth()->user()->cell;

		$name='User 8 by Tenant';
		$email='user8@example.com';
		
		// create or find user in Landlord if don't exists
		$landlordUserId = tenancy()->central(function ($tenant) use ($tenant_id, $name, $email, $cell) {
			
			Log::debug("tenant_id= ".$tenant_id);
			$account = \App\Models\Landlord\Account::where('site', $tenant_id)->first();
			
			// check if user need to create
			$createLandlordUser =false;

			// Find user with same email
			//Log::debug("email= ".$email);
			$user = \App\Models\User::where('email', $email)->first();

			// email not found and user with cell number
			if (is_null($user)) {
				$createLandlordUser =true;

				// try to find use with same mobile number
				if ($cell <> '') {
					$user = \App\Models\User::where('cell', $cell)->first();

					// user with same cell not found
					if (is_null($user)) {
						$createLandlordUser =true;
					} else {
						$createLandlordUser =false;
					}	
				}

				if ( $createLandlordUser ){
					Log::debug("create user for mail= ".$email.' cell = '. $cell);
					$random_password	= \Illuminate\Support\Str::random(12);

					$user = \App\Models\User::create([
						'name' 				=> $name,
						'email' 			=> $email,
						'cell' 				=> $cell,
						'email_verified_at'	=> NOW(),	//Already Verified in tenant
						'account_id' 		=> $account->id,
						'password' 			=> bcrypt($random_password),
					]);
					
					// Send notification on new user creation with initial password
					$user->notify(new \App\Notifications\Landlord\UserCreated($user, $random_password));
					Log::debug('Landlord user Created id=' . $user->id);
				}

			} else {
				Log::debug("user found = ".$email);
			}
			return $user->id;
		});

		
		Log::debug("landlordUserId = ".$landlordUserId);
		
		// now create the ticket under that landlord user
		$landlordTicket = tenancy()->central(function ($tenant) use ($landlordUserId, $request) {
				//Log::debug("email= ".$email);
				// now must get
				$user = \App\Models\User::where('id', $landlordUserId)->first();
				
				//Log::debug("Landlord User id = ".$user->id);
				// Create Ticket
				$ticket = \App\Models\Landlord\Ticket::create([
					'title' 		=> $request->input('title'),
					'content' 		=> $request->input('content'),
					'ticket_date'	=> date('Y-m-d H:i:s'),
					'status_code'	=> \App\Enum\LandlordTicketStatusEnum::NEW->value,
					'owner_id' 		=> $user->id,
					'account_id' 	=> $user->account_id,
					'dept_id' 		=> 1004,	// Support
					'priority_id' 	=> 1002,	// Medium
					'category_id' 	=> 1005,	// Technical Issue
				]);
				Log::debug('Ticket created =' . $ticket->id);

				//Write to Log
				\App\Helpers\LandlordEventLog::event('ticket', $ticket->id, 'create');

				// Upload File, if any, insert row in attachment table and get attachments id
				if ($file = $request->file('file_to_upload')) {
					$request->merge(['article_id'	=> $ticket->id]);
					$request->merge(['entity'		=> static::ENTITY]);
					$attachment_id = \App\Helpers\LandlordFileUpload::aws($request);

					// update back table with attachment_id
					$ticket->attachment_id = $attachment_id;
					$ticket->save();
				}

				// Send notification to Ticket creator
				$user->notify(new \App\Notifications\Landlord\TicketCreated($user, $ticket));

				// Send notification to Support Manager
				$mgr = \App\Models\User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
				$mgr->notify(new \App\Notifications\Landlord\TicketCreated($mgr, $ticket));

				return $ticket;
				
		});

		return redirect()->route('dashboards.index')->with('success', 'A New Ticket No ' .$landlordTicket->id . ' is created. We will come back to you soon. Thanks.');

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
