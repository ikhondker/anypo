@extends('layouts.landlord.app')
@section('title','Entity')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('entities.index') }}" class="text-muted">Entities</a></li>
	<li class="breadcrumb-item active">{{ $entity->entity }}</li>
@endsection


@section('content')

<h1 class="h3 mb-3">Edit Entity</h1>

<div class="card">
	<div class="card-header">

		<h5 class="card-title">Edit Entity (Admin Only)</h5>
		<h6 class="card-subtitle text-muted">Edit Entity Details.</h6>
	</div>
	<div class="card-body">
		<form id="myform" action="{{ route('entities.update',$entity->entity) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<table class="table table-sm my-2">
				<tbody>



					<x-landlord.edit.id-read-only :value="$entity->entity"/>
					<x-landlord.edit.name :value="$entity->name"/>


						<tr>
							<th>Model :</th>
							<td>
								<input type="text" class="form-control @error('model') is-invalid @enderror"
									name="model" id="model" placeholder="model"
									value="{{ old('model', $entity->model) }}"
									required/>
								@error('model')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>Route :</th>
							<td>
								<input type="text" class="form-control @error('route') is-invalid @enderror"
									name="route" id="route" placeholder="route"
									value="{{ old('route', $entity->route) }}"
									required/>
								@error('route')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>


						<tr>
							<th>Directory :</th>
							<td>
								<input type="text" class="form-control @error('directory') is-invalid @enderror"
									name="directory" id="directory" placeholder="directory"
									value="{{ old('directory', $entity->directory) }}"
									required/>
								@error('directory')
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
