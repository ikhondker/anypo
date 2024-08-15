@extends('layouts.landlord.app')
@section('title','All Domains')

@section('breadcrumb')
	<li class="breadcrumb-item active">All Domains</li>
@endsection

@section('content')

	<a href="{{ route('domains.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Domain</a>
	<h1 class="h3 mb-3">All Domains</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('domains.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-domain-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search configs…" required>
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
						<a href="{{ route('domains.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('domains.export') }}" class="btn btn-light btn-lg me-2"
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
						<th class="align-middle">Domain</th>
						<th class="align-middle">Tenant ID</th>
						<th class="align-middle">Date</th>
						<th class="align-middle">Status</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($domains as $domain)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>{{ $domain->id }}</td>
							<td>
								<a href="{{ route('domains.show', $domain->id) }}">
									<strong>{{ $domain->domain }}</strong>
								</a>
							</td>
							</td>
							<td>
								<a href="{{ route('domains.show', $domain->id) }}">
									<strong>{{ $domain->tenant_id }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-date :value="$domain->created_at"/></td>
							<td><x-landlord.list.my-badge :value="$domain->tenant_id"/></td>
							<td class="text-end">
								<a href="{{ route('domains.show',$domain->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $domains->links() }}
			</div>

		</div>
	</div>


@endsection
