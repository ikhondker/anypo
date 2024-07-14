<?php


namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\CustomError;
use App\Http\Requests\Tenant\Manage\StoreCustomErrorRequest;
use App\Http\Requests\Tenant\Manage\UpdateCustomErrorRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
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
use DB;
use Str;
use Illuminate\Support\Facades\Log;
# 13. FUTURE 


class CustomErrorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',CustomError::class);

		$customErrors = CustomError::query();
		if (request('term')) {
			$customErrors->where('message', 'Like', '%' . request('term') . '%');
		}
		$customErrors = $customErrors->orderBy('code', 'DESC')->paginate(10);
		return view('tenant.manage.custom-errors.index', compact('customErrors'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', CustomError::class);
		
		return view('tenant.manage.custom-errors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCustomErrorRequest $request)
	{
		$this->authorize('create', CustomError::class);
		
		$request->merge([
			'code' => Str::upper($request['code']),
		]);


		$customError = CustomError::create($request->all());
		// Write to Log
		EventLog::event('customError', $customError->code, 'create');

		return redirect()->route('custom-errors.index')->with('success', 'Custom Error created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(CustomError $customError)
	{
		$this->authorize('view', $customError);
		return view('tenant.manage.custom-errors.show', compact('customError'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(CustomError $customError)
	{
		$this->authorize('update', $customError);

		return view('tenant.manage.custom-errors.edit', compact('customError'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCustomErrorRequest $request, CustomError $customError)
	{
		$this->authorize('update', $customError);

		//$request->validate();
		$request->validate([
		]);
		$request->merge([
			'code' => Str::upper($request['code']),
		]);
		
		$customError->update($request->all());

		// Write to Log
		EventLog::event('customError', $customError->code, 'update', 'message', $request->message);

		return redirect()->route('custom-errors.index')->with('success', 'Custom Error updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(CustomError $customError)
	{
		$this->authorize('delete', $customError);

		$customError->fill(['enable' => ! $customError->enable]);
		$customError->update();
		// Write to Log
		EventLog::event('customError', $customError->code, 'status', 'enable', $customError->enable);

		return redirect()->route('custom-errors.index')->with('success', 'Dept status changed successfully');
	}

	public function export()
	{
		$this->authorize('export', CustomError::class);

		$data = DB::select("
			SELECT code, entity, message, IF(enable, 'Yes', 'No') as Enable, deleted_at, created_by, created_at, updated_by, updated_at
			FROM custom_errors
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('custom-errors', $dataArray);
	}
}

