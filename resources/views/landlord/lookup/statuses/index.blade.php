@extends('layouts.landlord-app')
@section('title', 'Statuses')
@section('breadcrumb', 'Statuses List')


@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Status List</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('statuses.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create Status
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Acc-Svc-Tkt-Chk-Inv-Pay</th>
						<th>Badge</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($statuses as $status)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
										src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark"
											href="{{ route('statuses.show', $status->code) }}">
											<h6 class="text-hover-primary mb-0">
												{{ $status->name }}
											</h6>
										</a>
										<small class="d-block">{{ $status->code }}</small>
									</div>
								</div>
							</td>
							<td>
								<i class="bi bi-circle-fill {{ $status->accounts ? 'text-success' : 'text-secondary' }}"
									style="font-size: 1rem;" data-bs-toggle="tooltip" data-bs-placement="top"
									title="Accounts"></i>
								<i class="bi bi-circle-fill {{ $status->services ? 'text-success' : 'text-secondary' }}"
										style="font-size: 1rem;" data-bs-toggle="tooltip" data-bs-placement="top"
										title="Services"></i>
								<i class="bi bi-circle-fill {{ $status->tickets ? 'text-success' : 'text-secondary' }}""
									style="font-size: 1rem;" data-bs-toggle="tooltip" data-bs-placement="top"
									title="tickets"></i>
								<i class="bi bi-circle-fill {{ $status->checkouts ? 'text-success' : 'text-secondary' }}""
									style="font-size: 1rem;" data-bs-toggle="tooltip" data-bs-placement="top"
									title="checkouts"></i>
								<i class="bi bi-circle-fill {{ $status->invoices ? 'text-success' : 'text-secondary' }}""
									style="font-size: 1rem;" data-bs-toggle="tooltip" data-bs-placement="top"
									title="invoices"></i>
								<i class="bi bi-circle-fill {{ $status->payments ? 'text-success' : 'text-secondary' }}""
									style="font-size: 1rem;" data-bs-toggle="tooltip" data-bs-placement="top"
									title="payments"></i>
							</td>
							<td><span class="badge bg-{{ $status->badge }}">{{ $status->badge }}</span></td>
							<td><x-landlord.list.my-enable :value="$status->enable" /></td>
							<td>
								<x-landlord.list.actions object="Status" :id="$status->code" />
								<a href="{{ route('statuses.delete', $status->code) }}"
									class="text-body sweet-alert2-confirm-advance" data-entity="Status"
									data-name="{{ $status->name }}"
									data-status="{{ $status->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $status->enable ? 'Disable' : 'Enable' }}">
									<i class="bi {{ $status->enable ? 'bi-bell-slash' : 'bi-bell' }} "
										style="font-size: 1.3rem;"></i>
								</a>
							</td>
						</tr>
					@endforeach


				</tbody>
			</table>
		</div>
		<!-- End Table -->


	</div>
	<!-- End Card -->

	@include('landlord.includes.sweet-alert2-confirm-advance')

@endsection
