<?php

namespace App\Http\Controllers\Landlord\Lookup;

use App\Http\Controllers\Controller;
use App\Models\Landlord\Lookup\Topic;
use App\Http\Requests\Landlord\Lookup\StoreTopicRequest;
use App\Http\Requests\Landlord\Lookup\UpdateTopicRequest;


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

class TopicController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Topic::class);
		$topics = Topic::query();
		if (request('term')) {
			$topics->where('name', 'Like', '%'.request('term').'%');
		}
		$topics = $topics->orderBy('name', 'ASC')->paginate(40);

		return view('landlord.lookup.topics.index', compact('topics'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Topic::class);
		return view('landlord.lookup.topics.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTopicRequest $request)
	{
		$this->authorize('create', Topic::class);
		$topic = Topic::create($request->all());
		// Write to Log
		EventLog::event('topic', $topic->id, 'create');
		return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Topic $topic)
	{
		$this->authorize('view', $topic);
		return view('landlord.lookup.topics.show', compact('topic'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Topic $topic)
	{
		$this->authorize('update', $topic);
		return view('landlord.lookup.topics.edit', compact('topic'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);

		$request->validate([
		]);
		$topic->update($request->all());

		// Write to Log
		EventLog::event('topic', $topic->id, 'update', 'name', $request->name);

		return redirect()->route('topics.index')->with('success', 'Topic updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Topic $topic)
	{
		$this->authorize('delete', $topic);

		$topic->fill(['enable'=>!$topic->enable]);
		$topic->update();

		// Write to Log
		EventLog::event('topic',$topic->id,'status','enable',$topic->enable);

		return redirect()->route('topics.index')->with('success','Topic Status Updated successfully');
	}
}
