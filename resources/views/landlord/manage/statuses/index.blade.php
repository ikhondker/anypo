@extends('layouts.landlord.app')
@section('title', 'Statuses')
@section('breadcrumb')
	<li class="breadcrumb-item active">Statuses</li>
@endsection

@section('content')

	<a href="{{ route('statuses.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Status</a>
	<h1 class="h3 mb-3">All Status</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('statuses.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-status-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search statuses…" required>
							<button class="btn" type="submit">
								<i data-lucide="search"></i>
							</button>
						</div>
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
						@endif
					</form>
					<!--/. form -->
				</div>
				<div class="col-md-6 col-xl-8">
					<div class="text-sm-end">
						<a href="{{ route('statuses.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('status.export') }}" class="btn btn-light btn-lg me-2"
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
						<th>Acc-Svc-Tkt-Chk-Inv-Pay</th>
						<th>Badge</th>
						<th>Icon</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($statuses as $status)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('statuses.show', $status->code) }}">
									<strong>{{ $status->code }}</strong>
								</a>
							</td>
							<td>{{ $status->name }}</td>
							<td>

								<i data-lucide="check-circle" class="{{ $status->accounts ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="Accounts"></i>
								<i data-lucide="check-circle" class="{{ $status->services ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="Services"></i>
								<i data-lucide="check-circle" class="{{ $status->tickets ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="tickets"></i>
								<i data-lucide="check-circle" class="{{ $status->checkouts ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="checkouts"></i>
								<i data-lucide="check-circle" class="{{ $status->invoices ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="invoices"></i>
								<i data-lucide="check-circle" class="{{ $status->payments ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="payments"></i>
							</td>
							<td><span class="badge bg-{{ $status->badge }}">{{ $status->badge }}</span></td>
							<td><i data-lucide="{{ $status->icon }}"></i></td>
							<td><x-landlord.list.my-enable :value="$status->enable" /></td>
							<td>
								<a href="{{ route('statuses.show',$status->code) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
								<a href="{{ route('statuses.edit',$status->code) }}" class="text-body" data-bs-toggle="tooltip"
										data-bs-placement="top" title="View"> <i data-lucide="edit"></i></a>
								<a href="{{ route('statuses.delete', $status->code) }}"
									class="text-body sw2-advance" data-entity="Status"
									data-name="{{ $status->route_name }}"
									data-status="{{ $status->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $status->enable ? 'Disable' : 'Enable' }}">
									<i data-lucide="{{ $status->enable ? 'bell-off' : 'bell' }}"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
