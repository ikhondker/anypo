@extends('layouts.landlord.app')
@section('title', 'All Tenants')
@section('breadcrumb', 'All Tenants')

@section('content')

	<a href="{{ route('tenants.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Tenant</a>
	<h1 class="h3 mb-3">All Tenants</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('tenants.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-tenant-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search tenants…" required>
							<button class="btn" type="submit">
								<i class="align-middle" data-lucide="search"></i>
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
						<a href="{{ route('tenants.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('tenants.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">ID</th>
						<th class="align-middle">Name</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tenants as $tenant)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('tenants.show', $tenant->id) }}">
									<strong>{{ $tenant->id }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-date :value="$tenant->created_at" /></td>
							<td class="text-end">
								<a href="{{ route('tenants.show',$tenant->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $tenants->links() }}
			</div>

		</div>
	</div>

@endsection
