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
							<x-landlord.show.my-text	value="{{ $contact->first_name.' '.$contact->last_name }}"/>
							<x-landlord.show.my-text	value="{{ $contact->email }}" label="E-mail"/>
							<x-landlord.show.my-text	value="{{ $contact->cell }}" label="Cell"/>
							<x-landlord.show.my-text	value="{{ $contact->subject }}" label="Subject"/>
							<x-landlord.show.my-text	value="{{ $contact->message }}" label="Message"/>
							<tr>
								<th>Attachments :</th>
								<td>
									@if ($contact->attachment_id <> '')
										<x-landlord.attachment.show-by-id id="{{ $contact->attachment_id }}"/>
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
