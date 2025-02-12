<?php


namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;


use App\Models\Landlord\Manage\Config;
use App\Http\Requests\Landlord\Manage\StoreConfigRequest;
use App\Http\Requests\Landlord\Manage\UpdateConfigRequest;

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
use Illuminate\Support\Facades\Log;
# 13. FUTURE

class ConfigController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$configs = Config::latest()->orderBy('id', 'desc')->paginate(10);
		return view('landlord.manage.configs.index', compact('configs'));
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
	public function store(StoreConfigRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Config $config)
	{
		$this->authorize('view', $config);
		return view('landlord.manage.configs.show', compact('config'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Config $config)
	{
		$this->authorize('update', $config);
		return view('landlord.manage.configs.edit', compact('config'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateConfigRequest $request, Config $config)
	{
		$this->authorize('update', $config);

		// check box
		if ($request->has('maintenance')) {
			//Checkbox checked
			$request->merge(['maintenance' => 1]);
            Log::error('landlord.manage.config.update Setting maintenance.');
		} else {
			//Checkbox not checked
			$request->merge(['maintenance' => 0]);
		}

		if ($request->has('banner')) {
			//Checkbox checked
			$request->merge(['banner' => 1]);
            Log::error('landlord.manage.config.update Setting banner.');
		} else {
			//Checkbox not checked
			$request->merge(['banner' => 0]);
		}

		$request->validate([]);
		$config->update($request->all());

		// Write to Log
		EventLog::event('config', $config->id, 'update', 'name', $request->name);

		return redirect()->route('configs.index')->with('success', 'Config updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Config $config)
	{
		abort(403);
	}
}
