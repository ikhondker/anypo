@extends('layouts.landlord.app')
@section('title','Edit Menu')
@section('breadcrumb','Edit Menu')

@section('content')


<div class="card">
	<div class="card-header">

		<h5 class="card-title">Edit Menu (Admin Only)</h5>
		<h6 class="card-subtitle text-muted">Edit Menu Details.</h6>
	</div>
	<div class="card-body">
		<form id="myform" action="{{ route('menus.update',$menu->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<table class="table table-sm my-2">
				<tbody>

					<x-landlord.edit.id-read-only :value="$menu->id"/>
				
						<tr>
							<th>Raw Route Name :</th>
							<td>
								<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
									name="raw_route_name" id="raw_route_name" placeholder="raw_route_name"
									value="{{ old('raw_route_name', $menu->raw_route_name  ) }}"
									required/>
								@error('raw_route_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>Route Name :</th>
							<td>
								<input type="text" class="form-control @error('route_name') is-invalid @enderror"
									name="route_name" id="route_name" placeholder="route_name"
									value="{{ old('route_name', $menu->route_name  ) }}"
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
									name="access" id="access" placeholder="access"
									value="{{ old('access', $menu->access  ) }}"
									required/>
								@error('access')
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
