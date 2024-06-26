@extends('layouts.landlord.app')
@section('title','Edit Status')
@section('breadcrumb','Edit Status')

@section('content')

	<h1 class="h3 mb-3">Edit Status</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Status (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Status Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('statuses.update',$status->code) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.edit.id-read-only :value="$status->code"/>
						<x-landlord.edit.name :value="$status->name"/>

							<tr>
								<th>Badge :</th>
								<td>
									<input type="text" class="form-control @error('badge') is-invalid @enderror"
										name="badge" id="badge" placeholder="badge"
										value="{{ old('badge', $status->badge  ) }}"
										required/>
									@error('badge')
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
