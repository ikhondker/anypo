<?php

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Manage\TicketTopic;
use App\Http\Requests\Landlord\Manage\StoreTicketTopicRequest;
use App\Http\Requests\Landlord\Manage\UpdateTicketTopicRequest;

use Illuminate\Support\Facades\Log;

class TicketTopicController extends Controller
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
	public function store(StoreTicketTopicRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(TicketTopic $ticketTopic)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(TicketTopic $ticketTopic)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTicketTopicRequest $request, TicketTopic $ticketTopic)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(TicketTopic $ticketTopic)
	{


		$this->authorize('delete', $ticketTopic);
		Log::debug('landlord.TicketTopicController.destroy ticket_topic_id= ' . $ticketTopic->id);
		$ticketTopic->delete();
		return redirect()->route('tickets.all')->with('success', 'Topic deleted.');

	}
}
