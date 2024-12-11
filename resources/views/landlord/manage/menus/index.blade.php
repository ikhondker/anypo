@extends('layouts.landlord.app')
@section('title', 'Menus')
@section('breadcrumb')
	<li class="breadcrumb-item active">Menus</li>
@endsection


@section('content')

	<a href="{{ route('menus.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Menu</a>
	<h1 class="h3 mb-3">All Menus</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('menus.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-menu-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search menus…" required>
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
						<a href="{{ route('menus.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('menus.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Menu Name</th>
						<th>Menu</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($menus as $menu)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('menus.show', $menu->id) }}">
									<strong>{{ $menu->raw_route_name }}</strong>
								</a>
							</td>
							<td>{{ $menu->route_name }}</td>
							<td><x-landlord.list.my-enable :value="$menu->enable" /></td>
							<td>
								<a href="{{ route('menus.show',$menu->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
								<a href="{{ route('menus.edit',$menu->id) }}" class="text-body" data-bs-toggle="tooltip"
										data-bs-placement="top" title="View"> <i data-lucide="edit"></i></a>
								<a href="{{ route('menus.delete', $menu->id) }}"
									class="text-body sw2-advance" data-entity="Menu"
									data-name="{{ $menu->route_name }}"
									data-status="{{ $menu->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $menu->enable ? 'Disable' : 'Enable' }}">
									<i data-lucide="{{ $menu->enable ? 'bell-off' : 'bell' }}"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $menus->links() }}
			</div>

		</div>
	</div>

@endsection
