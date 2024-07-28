@extends('layouts.landlord.app')
@section('title', 'config')
@section('breadcrumb')
	<li class="breadcrumb-item active">Configs</li>
@endsection

@section('content')

	<a href="{{ route('configs.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Config</a>
	<h1 class="h3 mb-3">All Configs</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('configs.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-config-search"
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
						<a href="{{ route('configs.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('configs.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Tagline</th>
						<th class="align-middle">Date</th>
						<th class="align-middle">Banner</th>
						<th class="align-middle">Maintenance</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($configs as $config)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('configs.show', $config->id) }}">
									<strong>{{ $config->name }}</strong>
								</a>
							</td>
							<td>{{ $config->tagline }}</td>
							<td><x-landlord.list.my-date :value="$config->created_at" /></td>
							<td><x-landlord.list.my-enable :value="$config->banner" /></td>
							<td><x-landlord.list.my-enable :value="$config->maintenance" /></td>
							<td class="text-end">
								<a href="{{ route('configs.show',$config->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $configs->links() }}
			</div>

		</div>
	</div>

@endsection
