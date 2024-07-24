@extends('layouts.landlord.app')
@section('title','Edit Activity')
@section('breadcrumb','Edit Activity')

@section('content')

	<h1 class="h3 mb-3">Edit Activity</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Activity (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Activity Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('activities.update',$activity->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>


						<x-landlord.edit.id-read-only :value="$activity->id"/>

							<tr>
								<th>Object Name :</th>
								<td>
									<input type="text" class="form-control @error('object_name') is-invalid @enderror"
										name="object_name" id="object_name" placeholder="object_name"
										value="{{ old('object_name', $activity->object_name ) }}"
										required/>
									@error('object_name')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Object ID :</th>
								<td>
									<input type="text" class="form-control @error('object_id') is-invalid @enderror"
										name="object_id" id="object_id" placeholder="object_id"
										value="{{ old('object_id', $activity->object_id ) }}"
										required/>
									@error('object_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>

							<tr>
								<th>Event Name:</th>
								<td>
									<input type="text" class="form-control @error('event_name') is-invalid @enderror"
										name="event_name" id="event_name" placeholder="event_name"
										value="{{ old('event_name', $activity->event_name) }}"
										required/>
									@error('event_name')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>

							<tr>
								<th>Column Name:</th>
								<td>
									<input type="text" class="form-control @error('column_name') is-invalid @enderror"
										name="column_name" id="column_name" placeholder="column_name"
										value="{{ old('column_name', $activity->column_name) }}"
										required/>
									@error('column_name')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>

							<tr>
								<th>Prior Value:</th>
								<td>
									<input type="text" class="form-control @error('prior_value') is-invalid @enderror"
										name="prior_value" id="prior_value" placeholder="prior_value"
										value="{{ old('prior_value', $activity->prior_value) }}"
										required/>
									@error('prior_value')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>


					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
