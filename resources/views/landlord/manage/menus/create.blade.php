@extends('layouts.landlord.app')
@section('title','Menu')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('menus.index') }}" class="text-muted">Menus</a></li>
	<li class="breadcrumb-item active">Create Menu</li>
@endsection


@section('content')

	<a href="{{ route('menus.index') }}" class="btn btn-primary float-end mt-n1 "><i class="fas fa-list"></i> View All</a>
	<h1 class="h3 mb-3">Create Menu</h1>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Create Menu</h5>
			<h6 class="card-subtitle text-muted">Create New Menu.</h6>
		</div>
		<div class="card-body">

			<form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Raw Route Name:</th>
							<td>
								<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
									name="raw_route_name" id="raw_route_name" placeholder="raw_route_name"
									value="{{ old('raw_route_name', '' ) }}"
									required/>
								@error('raw_route_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>Route Name:</th>
							<td>
								<input type="text" class="form-control @error('route_name') is-invalid @enderror"
									name="route_name" id="route_name" placeholder="route_name"
									value="{{ old('route_name', '' ) }}"
									required/>
								@error('route_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>Access :</th>
							<td>
								<input type="text" class="form-control @error('access') is-invalid @enderror"
									name="access" id="access" placeholder="P"
									value="{{ old('access', '' ) }}"
									required/>
								@error('access')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						
					</tbody>
				</table>
				<x-landlord.create.save/>
			</form>
		</div>
	</div>

@endsection


