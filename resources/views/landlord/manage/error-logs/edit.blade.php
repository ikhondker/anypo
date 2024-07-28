@extends('layouts.landlord.app')
@section('title','Edit Unhandled Error Log')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('error-logs.index') }}" class="text-muted">Error Logs</a></li>
	<li class="breadcrumb-item active">{{ $errorLog->id }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">Edit Error Log</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Error Log (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Error Log Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('error-logs.update',$errorLog->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>


						<x-landlord.edit.id-read-only :value="$errorLog->id"/>
						<x-landlord.show.my-text	value="{{ $errorLog->tenant }}"/>
						<x-landlord.show.my-text	value="{{ $errorLog->user_id }}" label="User"/>
						<x-landlord.show.my-text	value="{{ $errorLog->role }}" label="Role"/>
						<x-landlord.show.my-text	value="{{ $errorLog->e_class }}" label="e_class"/>
						<x-landlord.show.my-text-area	value="{{ $errorLog->message }}" label="message"/>
						<x-landlord.show.my-date value="{{ $errorLog->created_at }}" label="Created At:"/>


							<tr>
								<th>status :</th>
								<td>
									<input type="text" class="form-control @error('status') is-invalid @enderror"
										name="status" id="status" placeholder="status"
										value="{{ old('status', $errorLog->status) }}"
										required/>
									@error('status')
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


