@extends('layouts.landlord.app')
@section('title','Create Ticket')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">Create Ticket</li>
@endsection



@section('content')

	<a href="{{ route('tickets.index') }}" class="btn btn-primary float-end mt-n1 "><i class="fas fa-list"></i> View All</a>
	<h1 class="h3 mb-3">Create Ticket</h1>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Create Ticket</h5>
			<h6 class="card-subtitle text-muted">Create New Support Ticket.</h6>

		</div>
		<div class="card-body">

			<form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
				@csrf


				<table class="table table-sm my-2">
					<tbody>
						@if ( auth()->user()->isSeeded() )
							<tr>
								<th>For User :</th>
								<td>
									<select class="form-control select2" data-toggle="select2" name="owner_id" required>
										<option value=""><< User >> </option>
										@foreach ($owners as $user)
											<option value="{{ $user->id }}" {{ $user->id == old('owner_id') ? 'selected' : '' }} >{{ $user->name }} </option>
										@endforeach
									</select>
									@error('owner_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
						@else
							<input type="text" name="owner_id" id="owner_id" class="form-control" placeholder="ID" value="{{ auth()->user()->id }}" hidden>
						@endif
						<tr>
							<th>Subject :</th>
							<td>
								<input type="text" class="form-control @error('title') is-invalid @enderror"
									name="title" id="title" placeholder="Subject"
									value="{{ old('title', '' ) }}"
									required/>
								@error('title')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-landlord.create.content/>
						<tr>
							<th>Attachment :</th>
							<td>
								<x-landlord.attachment.create />
							</td>
						</tr>
					</tbody>
				</table>
				<x-landlord.create.save value="Ticket" />
			</form>
		</div>
	</div>


@endsection


