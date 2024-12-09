@extends('layouts.landlord.app')
@section('title','Checkouts')
@section('breadcrumb')
	<li class="breadcrumb-item active">Checkouts</li>
@endsection

@section('content')


	<a href="{{ route('checkouts.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Checkout</a>
	<h1 class="h3 mb-3">All Checkouts</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('checkouts.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-checkout-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search checkouts…" required>
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
						<a href="{{ route('checkouts.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('checkouts.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Type</th>
						<th>Name</th>
						<th>Email</th>
						<th>Site</th>
						<th>Date</th>
						<th>Price ($)</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($checkouts as $checkout)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo">
							</td>
							<td><x-landlord.list.my-badge :value="$checkout->invoice_type->value"/></td>
							<td>{{ $checkout->account_name }}</td>
							<td>{{ $checkout->email }}</td>
							<td>{{ $checkout->site }}</td>
							<td><x-landlord.list.my-date :value="$checkout->checkout_date"/></td>
							<td><x-landlord.list.my-number :value="$checkout->price"/></td>
							<td><x-landlord.list.my-badge :value="$checkout->status->name" badge="{{ $checkout->status->badge }}"/></td>
							<td>
								<a href="{{ route('checkouts.show',$checkout->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $checkouts->links() }}
			</div>

		</div>
	</div>

@endsection
