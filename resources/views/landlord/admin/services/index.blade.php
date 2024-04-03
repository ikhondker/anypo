@extends('layouts.landlord-app')
@section('title', 'My Services')
@section('breadcrumb', 'My Services')

@section('content')
@inject('carbon', 'Carbon\Carbon')

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			{{-- <h5 class="card-header-title">My Services {{ date('d-M-y', strtotime($account->end_date )) }} i.e. {{  $account->end_date->diffInDays($carbon::now()) }} days</h5> --}}
			<h5 class="card-header-title">My Services & Add-ons </h5>
		</div>
		
		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>From</th>
						<th>User</th>
						<th>Price</th>
						<th>Enable</th>
						<th style="width: 5%;">View</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($services as $service)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3ll')->url($service->account->logo) }}"
											alt="Image Description">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $service->name }}</h6>
										</a>
										<small class="d-block"> Account #{{ $service->account_id }} : {{ $service->account->name }}  </small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$service->start_date" /></td>
							<td>
								{{-- <span class="badge bg-primary rounded-pill">{{ $service->mnth }}</span> --}}
								<span class="badge bg-primary rounded-pill">{{ $service->user }}</span>
								{{-- <span class="badge bg-primary rounded-pill">{{ $service->gb }}</span> --}}
							</td>
							<td><x-landlord.list.my-number :value="$service->price" /></td>
							<td><x-landlord.list.my-enable value="{{ $service->enable }}" /></td>

							<td><x-landlord.list.actions object="Service" :id="$service->id" :edit="false" :enable="false" />
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->

	</div>
	<!-- End Card -->
	
	<x-landlord.widget.add-addon/>
	
	@include('landlord.includes.sweet-alert2-confirm-advance')

@endsection
