@extends('layouts.landlord.app')
@section('title','Edit Contact')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('contacts.index') }}" class="text-muted">Contacts</a></li>
	<li class="breadcrumb-item active">{{ $contact->first_name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">Edit Contact</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Contact (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Contact Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('contacts.update',$contact->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.edit.id-read-only :value="$contact->id"/>

							<tr>
								<th>First Name :</th>
								<td>
									<input type="text" class="form-control @error('first_name') is-invalid @enderror"
										name="first_name" id="first_name" placeholder="first_name"
										value="{{ old('first_name', $contact->first_name) }}"
										required/>
									@error('first_name')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Last Name :</th>
								<td>
									<input type="text" class="form-control @error('last_name') is-invalid @enderror"
										name="last_name" id="last_name" placeholder="last_name"
										value="{{ old('last_name', $contact->last_name) }}"
										required/>
									@error('last_name')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<x-landlord.edit.email :value="$contact->email" />
							<tr>
								<th>Contact Date :</th>
								<td>
									<input type="date" class="form-control @error('contact_date') is-invalid @enderror"
											name="contact_date" id="contact_date" placeholder="Name"
											value="{{ old('contact_date', $contact->contact_date ) }}"
											required/>
										@error('contact_date')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
								</td>
							</tr>
							<tr>
								<th>Subject :</th>
								<td>
									<input type="text" class="form-control @error('subject') is-invalid @enderror"
										name="subject" id="subject" placeholder="subject"
										value="{{ old('subject', $contact->subject) }}"
										required/>
									@error('subject')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<x-landlord.edit.notes value="{{ $contact->notes }}" />

					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
