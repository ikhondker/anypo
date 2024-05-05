@extends('layouts.landlord-app')
@section('title', 'My Services')
@section('breadcrumb', 'All Services')

@section('content')
	@inject('carbon', 'Carbon\Carbon')


	<!-- Card -->
	<div class="card">
		<div class="card-header">
			{{-- <h5 class="card-header-title">My Services {{ date('d-M-y', strtotime($account->end_date )) }} i.e. {{ $account->end_date->diffInDays($carbon::now()) }} days</h5> --}}
			<h5 class="card-header-title">All Services </h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Account</th>
						<th>Mnth-User-GB</th>
						<th>Price</th>
						<th>Addon?</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($services as $service)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3l')->url('logo/'.$service->account->logo) }}"
											alt="{{ $service->account->name }}" title="{{ $service->account->name }}">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('services.show', $service->id) }}">
											<h6 class="text-hover-primary mb-0">{{ $service->name }}</h6>
										</a>
										{{-- <small class="d-block">{{ $service->start_date }} to {{ $service->end_date }}</small> --}}
										<small class="d-block"> Account #{{ $service->account_id }} : {{ $service->account->name }} </small>
									</div>
								</div>
							</td>
							<td>{{ $service->account_id }}</td>
							<td>
								<span class="badge bg-primary rounded-pill">{{ $service->mnth }}</span>
								<span class="badge bg-primary rounded-pill">{{ $service->user }}</span>
								<span class="badge bg-primary rounded-pill">{{ $service->gb }}</span>
							</td>
							<td><x-landlord.list.my-number :value="$service->price" /></td>
							<td><x-landlord.list.my-enable :value="$service->addon" /></td>
							<td><x-landlord.list.my-enable value="{{ $service->enable }}" /></td>
							<td>
								<x-landlord.list.actions object="Service" :id="$service->id" :edit="false"	:enable="true" />
								<a href="{{ route('services.destroy', $service->id) }}"
									class="text-body sw2-advance" data-entity="Service"
									data-name="{{ $service->name }}"
									data-status="{{ $service->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $service->enable ? 'Disable' : 'Enable' }}">
									<i class="bi {{ $service->enable ? 'bi-bell-slash' : 'bi-bell' }} "
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





	

@endsection
