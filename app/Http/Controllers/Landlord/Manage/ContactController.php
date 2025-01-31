<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ContactController.php
* @brief		This file contains the implementation of the ContactController
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
use App\Http\Requests\Landlord\Manage\StoreContactRequest;
use App\Http\Requests\Landlord\Manage\UpdateContactRequest;

# 1. Models
use App\Models\Landlord\Manage\Contact;
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
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
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
# 13. FUTURE


class ContactController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'CONTACT';

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		abort(403);
	}



	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreContactRequest $request)
	{

		abort(403);
		// See [HomeController::class, 'saveContact']
		// $request->merge(['ip'	=> Request::ip()]);
		// $request->validate([
		// 	'name'		=> 'required',
		// 	'email'		=> 'required|email',
		// 	//'phone'	=> 'required|digits:10|numeric',
		// 	'subject'	=> 'required',
		// 	'message'	=> 'required'
		// ]);

		// Contact::create($request->all());
		// return redirect()->back()->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Contact $contact)
	{
		$this->authorize('view', $contact);
		$entity = static::ENTITY ;
		return view('landlord.manage.contacts.show',compact('contact','entity'));

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Contact $contact)
	{
		$this->authorize('update', $contact);
		return view('landlord.manage.contacts.edit', compact('contact'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateContactRequest $request, Contact $contact)
	{
		$this->authorize('update', $contact);

		$request->validate([]);
		$contact->update($request->all());

		return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Contact $contact)
	{
		//
	}


	/**
	 * Display a listing of the resource.
	 */
	public function all()
	{

		$this->authorize('viewAll',Contact::class);

		$contacts= Contact::orderBy('id', 'DESC')->paginate(10);
		return view('landlord.manage.contacts.all',compact('contacts'));
	}


	public function export()
	{
		$this->authorize('export', Contact::class);

		$data = DB::select("
			SELECT *
			FROM services as c
			");

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('contacts', $dataArray);

	}
}
