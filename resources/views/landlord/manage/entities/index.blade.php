@extends('layouts.landlord.app')
@section('title', 'Entities')
@section('breadcrumb')
	<li class="breadcrumb-item active">Entities</li>
@endsection

@section('content')

	<a href="{{ route('entities.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Entity</a>
	<h1 class="h3 mb-3">All Entity</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('entities.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-entity-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search configs…" required>
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
						<a href="{{ route('entities.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('entities.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Entity</th>
						<th>Name</th>
						<th>Model</th>
						<th>Directory</th>
						<th>Route</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($entities as $entity)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>{{ $entity->entity }}</td>
							<td>{{ $entity->name }}</td>
							<td>{{ $entity->directory }}</td>
							<td>{{ $entity->model }}</td>
							<td>{{ $entity->route }}</td>
							<td><x-landlord.list.my-enable :value="$entity->enable" /></td>
							<td>
								<a href="{{ route('entities.show',$entity->entity) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
								<a href="{{ route('entities.edit',$entity->entity) }}" class="text-body" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"> <i data-lucide="edit"></i></a>
								<a href="{{ route('entities.delete', $entity->entity) }}"
									class="text-body sw2-advance" data-entity="Entiry"
									data-name="{{ $entity->entity }}"
									data-status="{{ $entity->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $entity->enable ? 'Disable' : 'Enable' }}">
									<i data-lucide="{{ $entity->enable ? 'bell-off' : 'bell' }}"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $entities->links() }}
			</div>

		</div>
	</div>

@endsection
