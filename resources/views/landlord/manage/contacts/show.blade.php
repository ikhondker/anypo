@extends('layouts.landlord.app')
@section('title','View Contact')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('contacts.index') }}" class="text-muted">Contacts</a></li>
	<li class="breadcrumb-item active">{{ $contact->first_name }}</li>
@endsection


@section('content')
	<a href="{{ route('contacts.index') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-list"></i> View all</a>
	<h1 class="h3 mb-3">View Visitor Contact</h1>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a class="btn btn-sm btn-light" href="{{ route('contacts.edit', $contact->id) }}"><i class="fas fa-edit"></i> Edit</a>
						<a href="{{ route('contacts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					</div>
					<h5 class="card-title">View Visitor Contact</h5>
					<h6 class="card-subtitle text-muted">View Visitor Contact Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th>Type :</th>
								<td><span class="badge badge-subtle-success">{{ $contact->type }}</span></td>
							</tr>
							<x-landlord.show.my-date	value="{{ $contact->contact_date }}" label="E-mail"/>
							<x-landlord.show.my-text	value="{{ $contact->first_name.' '.$contact->last_name }}"/>
							<x-landlord.show.my-text	value="{{ $contact->email }}" label="E-mail"/>
							<x-landlord.show.my-text	value="{{ $contact->cell }}" label="Cell"/>
							<x-landlord.show.my-text	value="{{ $contact->subject }}" label="Subject"/>
							<x-landlord.show.my-text-area	value="{{ $contact->notes }}" label="Message"/>

							<x-landlord.show.my-text	value="{{ $contact->user_id }}" label="User"/>
							<x-landlord.show.my-text	value="{{ $contact->owner_id }}" label="Backoffice Owner"/>
							<x-landlord.show.my-text	value="{{ $contact->tenant }}" label="Tenant"/>

							<x-landlord.show.my-date	value="{{ $contact->demo_preferred_date }}" label="Demo Preferred Date"/>
							<x-landlord.show.my-enable	value="{{ $contact->demo_performed }}" label="Demo Done"/>
                            <x-landlord.show.my-date	value="{{ $contact->demo_date }}" label="Demo Date"/>
							<x-landlord.show.my-text-area	value="{{ $contact->notes_internal }}" label="Notes (Internal)"/>
							<x-landlord.show.my-text	value="{{ $contact->ip }}" label="IP"/>
							<tr>
								<th>Attachments :</th>
								<td>
									@if ($contact->attachment_id <> '')
										<x-landlord.attachment.show-by-id attachmentId="{{ $contact->attachment_id }}"/>
									@else
										[ None ]
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

@endsection
