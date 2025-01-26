<?php

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Manage\TicketTag;
use App\Http\Requests\Landlord\Manage\StoreTicketTagRequest;
use App\Http\Requests\Landlord\Manage\UpdateTicketTagRequest;

class TicketTagController extends Controller
{
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTicketTagRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(TicketTag $ticketTag)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(TicketTag $ticketTag)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTicketTagRequest $request, TicketTag $ticketTag)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(TicketTag $ticketTag)
	{
		$this->authorize('delete', $ticketTopic);

		$ticket_id 		= $ticketTopic->ticket_id;

		Log::debug('landlord.TicketTopicController.destroy ticket_topic_id= ' . $ticketTopic->id);
		$ticketTopic->delete();
		return redirect()->route('tickets.topics',$ticket_id )->with('success', 'Topic deleted.');
	}
}
