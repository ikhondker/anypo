<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			CommentController.php
* @brief		This file contains the implementation of the CommentController
* @path			\app\Http\Controllers\Landlord
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreCommentRequest;
use App\Http\Requests\Landlord\UpdateCommentRequest;

// Models
use App\Models\User;
use App\Models\Landlord\Comment;
use App\Models\Landlord\Ticket;

// Enums
use App\Enum\UserRoleEnum;
use App\Enum\LandlordTicketStatusEnum;

// Helpers
use App\Helpers\LandlordFileUpload;
use App\Helpers\LandlordEventLog;


// Notification
use Notification;
use App\Notifications\Landlord\TicketUpdated;
use App\Notifications\Landlord\TicketClosed;

// Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Request;



class CommentController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY   = 'COMMENT';


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreCommentRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCommentRequest $request)
	{
		// $this->authorize('create',Prl::class);
		//$request->merge(['pr_date'     => date('Y-m-d H:i:s')]);

		// if (auth()->user()->isBackOffice()){
		// 	$by_backoffice		= true;
		// } else {
		// 	$by_backoffice		= false;
		// }	

		$request->merge([
			'comment_date'		=> date('Y-m-d H:i:s'),
			//'ticket_number'	=> Str::uuid()->toString(),
			'owner_id'			=> auth()->user()->id ,
			'by_backoffice'		=> (auth()->user()->isBackOffice()? true : false ),
			'ip'				=> Request::ip()
		]);

		$isInternal =false;
		if($request->has('internal')){
			//Checkbox checked
			$request->merge(['is_internal'		=> true ]);
			$isInternal =true;
		}else{
			//Checkbox not checked
			$request->merge(['is_internal'		=> false ]);
			$isInternal =false;
		}

		// add comment
		$comment = Comment::create($request->all());

		 // Upload File, if any, insert row in attachment table and get attachments id
		 if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'    => $comment->id ]);
			$request->merge(['entity'       => static::ENTITY ]);
			$attachment_id = LandlordFileUpload::upload($request);

			// update back table with attachment_id
			$comment->attachment_id = $attachment_id;
			$comment->save();
		}

		// check if ticket is marked as closed
		// if($request->has('close')){
		//     //Checkbox checked
		//     $ticket = Ticket::where('id', $request->input('ticket_id') )->first();
		//     $ticket->status_code = LandlordTicketStatusEnum::RESOLVED->value;
		//     $ticket->update();

		//     // Send notification to Ticket creator if agent updates the tickets
		//     $owner = User::where('id', $ticket->owner_id)->first();
		//     $owner->notify(new TicketClosed($owner, $ticket));

		//     return redirect()->route('tickets.show',$request->input('ticket_id'))->with('success','Ticket Closed successfully');
		// }

		// change ticket status PENDING if customer is updating
		if (auth()->user()->isFrontOffice()) {
			$ticket = Ticket::where('id', $request->input('ticket_id') )->first();
			$ticket->status_code = LandlordTicketStatusEnum::PENDING->value;
			$ticket->update();
			//Log::debug("user updated ticket!");
			if ($ticket->agent_id <> ''){
				// Send notification to Assigned Agent if customer updates the ticket
				$agent = User::where('id',$ticket->agent_id )->first();
				$agent->notify(new TicketUpdated($agent, $ticket));
			}
		} elseif (auth()->user()->isBackOffice()) {
			// change ticket status if back office is updating
			$ticket = Ticket::where('id', $request->input('ticket_id') )->first();
			$status_code = $request->input('status_code');
			//$ticket->status_code = LandlordTicketStatusEnum::CUSTWORKING->value;
			$ticket->status_code = $status_code;
			$ticket->update();

			switch ($status_code) {
				case LandlordTicketStatusEnum::INPROGRESS->value:

					break;
				case LandlordTicketStatusEnum::CUSTWORKING->value:
					if (! $isInternal){
						// Send notification to Ticket creator if agent updates the tickets
						$owner = User::where('id', $ticket->owner_id)->first();
						$owner->notify(new TicketUpdated($owner, $ticket));
					}
					break;
				case LandlordTicketStatusEnum::RESOLVED->value:
					if (! $isInternal){
						// Send notification to Ticket creator if agent closes the tickets
						$owner = User::where('id', $ticket->owner_id)->first();
						$owner->notify(new TicketClosed($owner, $ticket));
					}
					return redirect()->route('tickets.show',$request->input('ticket_id'))->with('success','Ticket Closed successfully');
					break;
				default:
					Log::debug("Invalid status_code=". $status_code);
			}
		} else {
			Log::debug("Not an Front Office or Back Office! role=". auth()->user()->role->value ." Ticket=".  $request->input('ticket_id') );
		}

		// Write to Log
		LandlordEventLog::event('comment',$comment->id,'create');
		LandlordEventLog::event('ticket', $ticket->id, 'update', 'status_code', $ticket->status_code);

		return redirect()->route('tickets.show',$request->input('ticket_id'))->with('success','Ticket updated successfully');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Comment $comment)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Comment $comment)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateCommentRequest  $request
	 * @param  \App\Models\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCommentRequest $request, Comment $comment)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Comment $comment)
	{
		//
	}


}
