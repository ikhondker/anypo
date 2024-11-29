@extends('layouts.app')
@section('title','Entity')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('entities.index') }}" class="text-muted">Entities</a></li>
	<li class="breadcrumb-item active">Create Entity</li>
@endsection



@section('content')
	<div class="card col-8">

		<x-landlord.card.header object="Entity" title="Create Entity"/>

		<!-- form start -->
		<form action="{{ route('entities.store') }}" method="POST">
			@csrf

			<!-- card-body -->
			<div class="card-body">

				<div class="form-group row mb-4">
					<label for="entity" class="col-sm-2 col-form-label text-end text-secondary">Entity:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="entity" id="entity" placeholder="CODE"
							value="{{ old('entity', 'X001' ) }}"
							class="@error('entity') is-invalid @enderror" required>
						@error('entity')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<x-create.name/>

				<div class="form-group row mb-4">
					<label for="module" class="col-sm-2 col-form-label">Module:</label>
					<div class="col-sm-10">
						<select class="form-control form-control" name="module" id="module" required>
							<option value=""><< Module >> </option>
							@foreach ($modules as $module)
							<option value="{{ $module->module }}" {{ $module->module == old('module') ? 'selected' : '' }} >{{ $module->name.' ('.$module->module.')' }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="parent_entity" class="col-sm-2 col-form-label">Parent:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							style="text-transform: uppercase"
							name="parent_entity" id="parent_entity" placeholder="X002"
							value="{{ old('parent_entity', "" ) }}"
							class="@error('parent_entity') is-invalid @enderror">
						@error('parent_entity')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="subdir" class="col-sm-2 col-form-label">Sub Directory:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="subdir" id="subdir" placeholder="subdir"
							value="{{ old('subdir', "" ) }}"
							class="@error('subdir') is-invalid @enderror" required>
						@error('subdir')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-group row mb-4">
					<label for="route" class="col-sm-2 col-form-label">Routes:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="route" id="route" placeholder="routes"
							value="{{ old('route', "" ) }}"
							class="@error('route') is-invalid @enderror">
						@error('route')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				{{-- <div class="form-group row mb-4">
					<label for="module" class="col-sm-2 col-form-label">Module:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="module" id="module" placeholder="HR"
							value="{{ old('module', "XX" ) }}"
							class="@error('module') is-invalid @enderror" required>
						@error('module')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div> --}}



				<<x-create.save/>

			</div>
			<!-- /.card-body -->

		</form>
		<!-- /.form end -->

		<x-card.footer-list object="Entity"/>

	</div>
@endsection
