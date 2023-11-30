@extends('layouts.landlord-app')
@section('title', 'My Services')
@section('breadcrumb', 'My Services')

@section('content')
@inject('carbon', 'Carbon\Carbon')
   

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			{{-- <h5 class="card-header-title">My Services {{ date('d-M-y', strtotime($account->end_date )) }} i.e. {{  $account->end_date->diffInDays($carbon::now()) }} days</h5> --}}
			<h5 class="card-header-title">My Services {{ date('d-M-y', strtotime($account->end_date )) }} i.e. {{  $account->end_date->diffInDays($carbon::now()) }} days</h5>
		</div>
		
		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>User</th>
						<th>Month</th>
						<th>GB</th>
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
										<img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img8.jpg"
											alt="Image Description">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $service->name }}</h6>
										</a>
										<small class="d-block">SKU:{{ $service->product->sku }}</small>
									</div>
								</div>
							</td>
							<td>{{ $service->user }}</td>
							<td><x-landlord.list.my-integer :value="$service->mnth" /></td>
							<td><x-landlord.list.my-integer :value="$service->gb" /></td>
							<td><x-landlord.list.my-number :value="$service->price" /></td>
							<td><x-landlord.list.my-enable :value="$service->addon" /></td>
							<td><x-landlord.list.my-enable value="{{ $service->enable }}" /></td>
							<td><x-landlord.list.actions object="Service" :id="$service->id" :edit="false"
									:enable="true" />
								<a href="{{ route('services.destroy', $service->id) }}"
									class="text-body sweet-alert2-confirm-advance" data-entity="Service"
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
	
	@php
		
		//$cur_account_id =  $account->id;
		$days_to_expire = $account->end_date->diffInDays($carbon::now());
		$months_to_expire =round($days_to_expire/30);
		
		// TODO replace with _landlord_setup
		if ( $days_to_expire > 35 ){
			$pay_for_addon = true;
		} else {
			$pay_for_addon = false;
		}
	@endphp

	@if ($account->id != '' )
		<!-- Card Grid -->
		<div class="container content-space-2">
			<!-- Heading -->
			<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
				<span class="text-cap">Add-ons {{$account->id }} </span>
				<h2 class="h1">Need More? Buy Addon </h2>
			</div>
			<!-- End Heading -->
		
			<div class="row justify-content-center">

				@foreach ($addons as $addon)

					@php
						$payable_addon_list = $months_to_expire * $addon->list_price;
						$payable_addon = $months_to_expire * $addon->price;
					@endphp
					<div class="col-md-6 col-lg-4 mb-4 mb-md-5 mb-lg-0">
						<!-- Card -->
						
							<div class="card card-lg card-transition h-100 text-center">
								<div class="card-body">
									<div class="mb-4">
										<i class="bi bi-plus-circle" style="font-size: 2.3rem;"></i>
									</div>
									<h3 class="card-title">{{ $addon->name }}</h3>
									<h4 class="card-title text-primary"> <del>{{ $addon->list_price }}</del> {{ $addon->price }}$/mo</h4>
									<p class="card-text text-body">
									</p>
									@if ($pay_for_addon)
										<p class="card-text text-body">Your current subscription will expire {{ date('d-M-y', strtotime($account->end_date )) }} i.e. in {{ $months_to_expire }}+ months.</p>
										<p class="card-text text-body">To maintain single billing date, payable amount till next bill date will be </p>
										<h4 class="card-title text-primary"> <del>{{ $payable_addon_list }}</del> {{ $payable_addon }}$</h4>
									@else
										<p class="card-text text-body">You will be charged for this addon from next bill cycle.</p>
										<p class="card-text text-body small">Use it <span class="badge bg-primary"> free </span> for remaining days till next billing date {{ strtoupper(date('d-M-Y', strtotime($account->end_date))) }}.</p>
										<p class="card-text text-body small">Will be activated immediately.</p>
									@endif 
									
								</div>
								<div class="card-footer pt-0">
									@if ($pay_for_addon)
										<form action="{{ url('/paymentaddon') }}" method="POST" class="needs-validation">
											<input type="hidden" value="{{ csrf_token() }}" name="_token" />
											<input type="hidden" name="addon_id" value="{{ $addon->id }}">
											<input type="hidden" name="payable_addon" value="{{ $payable_addon }}">
											<button class="btn btn-primary btn-sm" type="submit">
												<i class="bi bi-plus-square me-1"></i>Pay Invoice (Hosted)
											</button>
										</form>  
									@else
										<a href="{{ route('accounts.addaddon', ['account_id' => $account->id, 'addon_id' => $addon->id]) }}"
										class="btn btn-success" onclick="return confirm('Are you sure?')">Buy Now</a>
									@endif 
								</div>
							</div>
						
						<!-- End Card -->
					</div>
					<!-- End Col -->  
				@endforeach
			
			</div>
			<!-- End Row -->
		</div>
		<!-- End Card Grid -->
	@endif
	
	@include('landlord.includes.sweet-alert2-confirm-advance')

@endsection
