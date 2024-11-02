@extends('layouts.landlord.app')
@section('title','Visitor Contact')
@section('breadcrumb')
	<li class="breadcrumb-item active">Contacts</li>
@endsection

@section('content')


<a href="{{ route('contacts.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Contact</a>
<h1 class="h3 mb-3">All Contacts</h1>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
				<!-- form -->
				<form action="{{ route('contacts.all') }}" method="GET" role="search">
					<div class="input-group input-group-search">
						<input type="text" class="form-control" id="datatables-contact-search"
							minlength=3 name="term"
							value="{{ old('term', request('term')) }}" id="term"
							placeholder="Search contacts…" required>
						<button class="btn" type="submit">
							<i data-lucide="search"></i>
						</button>
					</div>
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@endif
				</form>
				<!--/. form -->
			</div>
			<div class="col-md-6 col-xl-8">

				<div class="text-sm-end">
					<a href="{{ route('contacts.all') }}" class="btn btn-primary btn-lg"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
						<i data-lucide="refresh-cw"></i></a>
					<a href="{{ route('contacts.export') }}" class="btn btn-light btn-lg me-2"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
						<i data-lucide="download"></i> Export</a>
				</div>
			</div>
		</div>

		<table id="datatables-orders" class="table w-100">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Date</th>
					<th>Subject</th>
					<th>Attachment</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($contacts as $contact)
					<tr>
						<td>
							<img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar" title="Avatar">
						</td>
						<td>
							<a href="{{ route('contacts.show', $contact->id) }}">
							<strong>{{ $contact->first_name.' '.$contact->last_name }}</strong>
							</a>
						</td>
						<td><x-landlord.list.my-date :value="$contact->created_at"/></td>
						<td>{{ Str::limit($contact->subject,15) }}</td>
						<td><x-landlord.attachment.show-by-id id="{{ $contact->attachment_id }}"/></td>
						<td>
							<a href="{{ route('contacts.show',$contact->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
								data-bs-placement="top" title="View">View</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row mb-3">
			{{ $contacts->links() }}
		</div>

	</div>
</div>

@endsection

