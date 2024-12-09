@extends('layouts.landlord.app')
@section('title', 'Country List')
@section('breadcrumb')
	<li class="breadcrumb-item active">Countries</li>
@endsection


@section('content')

	@if (auth()->user()->isSystem())
		<a href="{{ route('countries.create') }}" class="btn btn-danger text-white float-end mt-n1"><i data-lucide="plus"></i> New Country(*)</a>
	@endif

	<h1 class="h3 mb-3">All Countries</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('countries.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-country-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search countries…" required>
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
						<a href="{{ route('countries.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('countries.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Name</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($countries as $country)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('flags/'. Str::lower($country->country).'.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>{{ $country->country }}</td>
							<td>
								<a href="{{ route('countries.show', $country->country) }}">
									<strong>{{ $country->name }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-enable :value="$country->enable" /></td>
							<td>
								<a href="{{ route('countries.show',$country->country) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>

									<a href="{{ route('countries.delete', $country->country) }}"
										class="text-body sw2-advance" data-entity="Country"
										data-name="{{ $country->name }}"
										data-status="{{ $country->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
										data-bs-placement="top" title="{{ $country->enable ? 'Disable' : 'Enable' }}">
										<i data-lucide="{{ $country->enable ? 'bell-off' : 'bell' }}"></i>
									</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $countries->links() }}
			</div>

		</div>
	</div>


@endsection
