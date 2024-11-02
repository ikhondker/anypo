<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CommentController.php
* @brief		This file contains the implementation of the CommentController
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
use App\Http\Requests\Landlord\StoreCommentRequest;
use App\Http\Requests\Landlord\UpdateCommentRequest;

# 1. Models
use App\Models\User;
use App\Models\Landlord\Comment;
use App\Models\Landlord\Ticket;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\Landlord\TicketStatusEnum;
# 3. Helpers
use App\Helpers\Landlord\FileUpload;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Landlord\TicketUpdated;
use App\Notifications\Landlord\TicketClosed;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Request;
# 13. FUTURE



class CommentController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'COMMENT';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort(403);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		$this->authorize('viewAny', Comment::class);
		$comments = Comment::query();
		if (request('term')) {
			$comments->where('content', 'Like', '%'.request('term').'%');
		}
		$comments = $comments->orderBy('id', 'DESC')->paginate(40);

		return view('landlord.comments.all', compact('comments'));
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
	 * @param \App\Http\Requests\StoreCommentRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCommentRequest $request)
	{
		// $this->authorize('create',Prl::class);
		//$request->merge(['pr_date' => date('Y-m-d H:i:s')]);


		$request->merge([
			'comment_date'		=> date('Y-m-d H:i:s'),
			//'ticket_number'	=> Str::uuid()->toString(),
			'owner_id'			=> auth()->user()->id ,
			'by_backoffice'		=> (auth()->user()->isSeeded()? true : false ),
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
			$request->merge(['article_id'	=> $comment->id ]);
			$request->merge(['entity'		=> static::ENTITY ]);
			//$attachment_id = FileUpload::upload($request);
			$attachment_id = FileUpload::aws($request);
			// update back table with attachment_id
			$comment->attachment_id = $attachment_id;
			$comment->save();
		}

		// change ticket status PENDING if customer is updating
		if (auth()->user()->isSeeded()) {
			// change ticket status if back office is updating
			$ticket = Ticket::where('id', $request->input('ticket_id') )->first();
			$status_code = $request->input('status_code');
			$ticket->status_code = $status_code;

            // set first_response_at , last_response_at
            if (! $comment->is_internal){
                // if public response and first_response_at is null
                if ($ticket->first_response_at == null){
                    $ticket->first_response_at = now();
                }
                $ticket->last_response_at = now();
            }

            $ticket->update();

			switch ($status_code) {
				case TicketStatusEnum::INPROGRESS->value:
					break;
				case TicketStatusEnum::CWIP->value:
					if (! $isInternal){
						// Send notification to Ticket creator if agent updates the tickets
						$owner = User::where('id', $ticket->owner_id)->first();
						$owner->notify(new TicketUpdated($owner, $ticket));
					}
					break;
				// case TicketStatusEnum::RESOLVED->value:
				// 	if (! $isInternal){
				// 		// Send notification to Ticket creator if agent closes the tickets
				// 		$owner = User::where('id', $ticket->owner_id)->first();
				// 		$owner->notify(new TicketClosed($owner, $ticket));
				// 	}
				// 	return redirect()->route('tickets.show',$request->input('ticket_id'))->with('success','Ticket Closed successfully');
				// 	break;
				default:
					Log::channel('bo')->info('landlord.comment.store Invalid status_code = '. $status_code);
			}
		} else {
			$ticket = Ticket::where('id', $request->input('ticket_id') )->first();
			$ticket->status_code = TicketStatusEnum::PENDING->value;
            // update user last message date
            $ticket->last_message_at = now();
			$ticket->update();
			if ($ticket->agent_id <> ''){
				// Send notification to Assigned Agent if customer updates the ticket
				$agent = User::where('id',$ticket->agent_id )->first();
				$agent->notify(new TicketUpdated($agent, $ticket));
			}
		}

		// Write to Log
		EventLog::event('comment',$comment->id,'create');
		EventLog::event('ticket', $ticket->id, 'update', 'status_code', $ticket->status_code);

		return redirect()->route('tickets.show',$request->input('ticket_id'))->with('success','Ticket updated successfully');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Comment $comment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Comment $comment)
	{
		$this->authorize('view', $comment);
		return view('landlord.comments.show', compact('comment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Comment $comment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Comment $comment)
	{
		$this->authorize('update', $comment);
		return view('landlord.comments.edit', compact('comment'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\UpdateCommentRequest $request
	 * @param \App\Models\Comment $comment
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCommentRequest $request, Comment $comment)
	{
		$this->authorize('update', $comment);

		$request->validate([
		]);
		$comment->update($request->all());

		// Write to Log
		EventLog::event('comment', $comment->id, 'update', 'name', $request->name);

		return redirect()->route('comments.all')->with('success', 'Comment updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Comment $comment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Comment $comment)
	{
		//
	}


}
