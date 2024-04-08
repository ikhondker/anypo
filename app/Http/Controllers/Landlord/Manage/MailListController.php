<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			EntityController.php
* @brief		This file contains the implementation of the MailListController
* @path			\app\Http\Controllers\Landlord\Manage
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

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Manage\MailList;
use App\Http\Requests\Landlord\Manage\StoreMailListRequest;
use App\Http\Requests\Landlord\Manage\UpdateMailListRequest;


# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\LandlordEventLog;
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


class MailListController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', MailList::class);
		$mailLists = MailList::query();
		if (request('term')) {
			$mailLists->where('email', 'Like', '%'.request('term').'%');
		}
		$mailLists = $mailLists->orderBy('email', 'ASC')->paginate(40);

		return view('landlord.manage.mail-lists.index', compact('mailLists'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreMailListRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(MailList $mailList)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(MailList $mailList)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateMailListRequest $request, MailList $mailList)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(MailList $mailList)
	{
		$this->authorize('delete', $mailList);

		$mailList->fill(['enable' => ! $mailList->enable]);
		$mailList->update();
		// Write to Log
		LandlordEventLog::event('mailList', $mailList->id, 'status', 'enable', $mailList->enable);

		return redirect()->route('mail-lists.index')->with('success', 'MailList status Updated successfully');
	}
}
