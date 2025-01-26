<?php

namespace App\Http\Controllers\Landlord\Lookup;
use App\Http\Controllers\Controller;
use App\Models\Landlord\Lookup\Tag;

use App\Http\Requests\Landlord\Lookup\StoreTagRequest;
use App\Http\Requests\Landlord\Lookup\UpdateTagRequest;


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

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Tag::class);
		$tags = Tag::query();
		if (request('term')) {
			$tags->where('name', 'Like', '%'.request('term').'%');
		}
		$tags = $tags->orderBy('name', 'ASC')->paginate(40);

		return view('landlord.lookup.tags.index', compact('tags'));

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Tag::class);
		return view('landlord.lookup.tags.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTagRequest $request)
	{
		$this->authorize('create', Tag::class);
		$tag = Tag::create($request->all());
		// Write to Log
		EventLog::event('tag', $tag->id, 'create');
		return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tag $tag)
	{
		$this->authorize('view', $tag);
		return view('landlord.lookup.tags.show', compact('tag'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tag $tag)
	{
		$this->authorize('update', $tag);
		return view('landlord.lookup.tags.edit', compact('tag'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTagRequest $request, Tag $tag)
	{
		$this->authorize('update', $tag);

		$request->validate([
		]);
		$tag->update($request->all());

		// Write to Log
		EventLog::event('tag', $tag->id, 'update', 'name', $request->name);

		return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tag $tag)
	{
		$this->authorize('delete', $tag);

		$tag->fill(['enable'=>!$tag->enable]);
		$tag->update();

		// Write to Log
		EventLog::event('tag',$tag->id,'status','enable',$tag->enable);

		return redirect()->route('tags.index')->with('success','Tag Status Updated successfully');
	}
}
