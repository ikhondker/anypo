@extends('layouts.landlord.app')
@section('title', 'My Services')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Services</li>
@endsection


@section('content')
	@inject('carbon', 'Carbon\Carbon')


	<h1 class="h3 mb-3">All Services</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('services.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-service-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search services…" required>
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
						<a href="{{ route('services.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('services.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Account</th>
						<th class="align-middle">Date</th>
						<th class="align-middle">Mnth-User-GB</th>
						<th class="align-middle">Price</th>
						<th class="align-middle">Addon?</th>
						<th class="align-middle">Enable</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($services as $service)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/'.$service->account->logo) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $service->account->name }}" title="{{ $service->account->name }}">
							</td>
							<td>
								<a class="" href="{{ route('services.show', $service->id) }}">
									<strong>{{ $service->name }}</strong>
								</a>
							</td>
							<td>{{ $service->account->name }}</td>
							<td>{{ strtoupper(date('d-M-Y', strtotime( $service->start_date)))  }} </td>
							<td>
								<span class="badge badge-subtle-primary rounded-pill">{{ $service->mnth }}</span>
								<span class="badge badge-subtle-primary rounded-pill">{{ $service->user }}</span>
								<span class="badge badge-subtle-primary rounded-pill">{{ $service->gb }}</span>
							</td>
							<td><x-landlord.list.my-number :value="$service->price" /></td>
							<td><x-landlord.list.my-enable :value="$service->addon" /></td>
							<td><x-landlord.list.my-enable value="{{ $service->enable }}" /></td>
							<td class="text-end">
								<a href="{{ route('services.show',$service->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $services->links() }}
			</div>

		</div>
	</div>





@endsection
