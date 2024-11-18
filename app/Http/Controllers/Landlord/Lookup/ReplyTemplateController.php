<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CategoryController.php
* @brief		This file contains the implementation of the CategoryController
* @path			\app\Http\Controllers\Landlord\Lookup
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

namespace App\Http\Controllers\Landlord\Lookup;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Lookup\ReplyTemplate;
use App\Http\Requests\Landlord\Lookup\StoreReplyTemplateRequest;
use App\Http\Requests\Landlord\Lookup\UpdateReplyTemplateRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
# 13. FUTURE


class ReplyTemplateController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', ReplyTemplate::class);
		$replyTemplates = ReplyTemplate::query();
		if (request('term')) {
			$replyTemplates->where('name', 'Like', '%'.request('term').'%');
		}
		$replyTemplates = $replyTemplates->orderBy('id', 'ASC')->paginate(40);

		return view('landlord.lookup.reply-templates.index', compact('replyTemplates'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', ReplyTemplate::class);
		return view('landlord.lookup.reply-templates.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreReplyTemplateRequest $request)
	{
		$this->authorize('create', ReplyTemplate::class);
		$replyTemplate = ReplyTemplate::create($request->all());
		// Write to Log
		EventLog::event('replyTemplate', $replyTemplate->id, 'create');
		return redirect()->route('reply-templates.index')->with('success', 'ReplyTemplate created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ReplyTemplate $replyTemplate)
	{
		$this->authorize('view', $replyTemplate);
		return view('landlord.lookup.reply-templates.show', compact('replyTemplate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(ReplyTemplate $replyTemplate)
	{
		$this->authorize('update', $replyTemplate);
		return view('landlord.lookup.reply-templates.edit', compact('replyTemplate'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReplyTemplateRequest $request, ReplyTemplate $replyTemplate)
	{
		$this->authorize('update', $replyTemplate);

		$request->validate([
		]);
		$replyTemplate->update($request->all());

		// Write to Log
		EventLog::event('replyTemplate', $replyTemplate->id, 'update', 'name', $request->name);

		return redirect()->route('reply-templates.index')->with('success', 'ReplyTemplate updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(ReplyTemplate $replyTemplate)
	{
		$this->authorize('delete', $replyTemplate);

		$replyTemplate->fill(['enable'=>!$replyTemplate->enable]);
		$replyTemplate->update();

		// Write to Log
		EventLog::event('replyTemplate',$replyTemplate->id,'status','enable',$replyTemplate->enable);

		return redirect()->route('reply-templates.index')->with('success','ReplyTemplate Status Updated successfully');
	}

	// user in Ticket create comment dropdown ajax
	public function getTemplate($id = 0)
	{
		//http://demo1.localhost:8000/reply-templates/get-template/1005
		$data = [];
		//Log::info('id='.$id);
		$data = ReplyTemplate::select('name','notes')->where('id', $id)->first();
		//Log::debug('Value of data=' . $data);
		return response()->json($data);

	}

}
