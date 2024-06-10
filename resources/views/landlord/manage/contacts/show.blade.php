@extends('layouts.landlord.app')
@section('title','View Contact')
@section('breadcrumb','View Contact')

@section('content')

<!-- Card -->
<div class="card">
	<div class="card-header border-bottom">
		<h4 class="card-header-title">View Visitor Contact</h4>
	</div>

	<!-- Body -->
	<div class="card-body">

		<x-landlord.show.my-text	value="{{ $contact->first_name.' '.$contact->last_name }}"/>
		<x-landlord.show.my-text	value="{{ $contact->email }}" label="E-mail"/>
		<x-landlord.show.my-text	value="{{ $contact->cell }}" label="Cell"/>
		<x-landlord.show.my-text	value="{{ $contact->subject }}" label="Subject"/>
		<x-landlord.show.my-text	value="{{ $contact->message }}" label="Message"/>

		<div class="row mb-4">
			<label class="col-sm-3 col-form-label form-label">Attachments:</label>
			<div class="col-sm-9 col-form-label">
				@if ($contact->attachment_id <> '')
					<x-landlord.attachment.show-by-id id="{{ $contact->attachment_id }}"/>
				@else
					[ None ]
				@endif
			</div>
		</div>

		<x-landlord.show.my-date-time	value="{{ $contact->created_at }}" label="Date"/>
		<x-landlord.show.my-badge		value="{{ $contact->id }}" label="ID"/>
		<x-landlord.show.my-text		value="{{ $contact->ip }}" label="IP"/>

	</div>
	<!-- End Body -->

	<!-- Footer -->
	<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Edit</a>
		</div>
	</div>
	<!-- End Footer -->
</div>
<!-- End Card -->


@endsection
