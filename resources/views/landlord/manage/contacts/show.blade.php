@extends('layouts.landlord.app')
@section('title','View Contact')
@section('breadcrumb','View Contact')

@section('content')
	<h1 class="h3 mb-3">View Visitor Contact</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('contacts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i>  View all</a>
						<a class="btn btn-sm btn-light" href="{{ route('contacts.edit', $contact->id) }}"><i class="fas fa-edit"></i> Edit</a>

					</div>
					<h5 class="card-title">View Visitor Contact</h5>
					<h6 class="card-subtitle text-muted">View Visitor Contact Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
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
		</div>
	</div>
@endsection
