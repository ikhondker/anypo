@extends('layouts.landlord-app')
@section('title','My Account')
@section('breadcrumb','My Account')


@section('content')
<!-- Card -->
<div class="card">
	<div class="card-header">
		<h5 class="card-header-title">Your Current Subscription</h5>
	</div>

	<!-- Table -->
	<div class="table-responsive">
		<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
			<thead class="thead-light">
				<tr>
					<th>Name</th>
					<th>Start</th>
					<th>End</th>
					<th>User</th>
					<th>Amount</th>
					<th>Status</th>
					<th style="width: 5%;">Action</th>
				</tr>
			</thead>

			<tbody>
				@forelse  ($accounts as $account)
				<tr>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3ll')->url($account->logo) }}"  alt="{{ $account->name }}" title="{{ $account->name }}">
							</div>

							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="{{ route('accounts.show',$account->id) }}">
									<h6 class="text-hover-primary mb-0">{{ $account->name }} [{{ $account->site }}]</h6>
								</a>
								<small class="d-block">Owner: {{ $account->owner->name }} </small>
							</div>
						</div>
					</td>
					<td><x-landlord.list.my-date :value="$account->start_date" /></td>
					<td><x-landlord.list.my-date :value="$account->end_date" /></td>
					<td>{{ $account->user }}</td>	
					<td><x-landlord.list.my-number :value="$account->price"/>$</td>
					<td><x-landlord.list.my-badge :value="$account->status->name" badge="{{ $account->status->badge }}" /></td>
					<td><x-landlord.list.actions object="Account" :id="$account->id" :export="false" :enable="false" /></td>
				</tr>
				@empty
				<tr>
					<td colspan="5" class="text-center">
    					<span>No billing account exists! Please <a href="{{ route('home.pricing') }}"> purchase</a> the service first.</span>
					</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>
	<!-- End Table -->

	@if ($account->id != '' )
		<!-- Card Grid -->
		<div class="container content-space-2">
			
			<div class="row justify-content-center mb-4">
				<div class="col-8 mb-4 mb-md-5 mb-lg-0">
					<!-- Card -->
						<div class="card card-lg card-transition h-100 text-center">
							<div class="card-body">
								<span class="text-cap">Additional User</span>
								<h2 class="h1">Need More User? Buy </h2>
								<p class="card-text text-body small">Will be activated immediately.</p>
							</div>			
						</div>
				</div>
			</div>

			<div class="row justify-content-center">

				@foreach ($addons as $addon)
					<div class="col-md-6 col-lg-4 mb-4 mb-md-5 mb-lg-0">
						<!-- Card -->
							<div class="card card-lg card-transition h-100 text-center">
								<div class="card-body">
									<div class="mb-4">
										@if ($addon->addon_type =='user')
											<i class="bi bi-people text-primary" style="font-size: 4.3rem;"></i>
										@else
											<i class="bi bi-floppy text-primary" style="font-size: 4.3rem;"></i>
										@endif		
									</div>
									<h3 class="card-title">{{ $addon->name }}</h3>
									<h4 class="card-title text-primary"> <del>{{ $addon->list_price }}</del> {{ $addon->price }}$/mo</h4>
									{{-- <p class="card-text text-body"></p> --}}
									<p class="card-text text-body small">Next billing date {{ strtoupper(date('d-M-Y', strtotime($account->end_date))) }}.</p>
								</div>
								<div class="card-footer pt-0">
										<a href="{{ route('accounts.add-addon', ['account_id' => $account->id, 'addon_id' => $addon->id]) }}"
											class="btn btn-primary sweet-alert2-confirm-advance"
											data-entity="Add-On" data-name="{{ $addon->name }}"
											data-status="BUY" data-bs-toggle="tooltip"
											data-bs-placement="top" title="Add-on">
											Buy Now
										</a>
								</div>
							</div>
						
						<!-- End Card -->
					</div>
					<!-- End Col -->  
				@endforeach
				<span class="small text-center mt-2">NOTE: Once added, Add-ons can not be removed or deactivated.</span>
			</div>
			<!-- End Row -->
		</div>
		<!-- End Card Grid -->
	@endif
	
	@include('landlord.includes.sweet-alert2-confirm-advance')

</div>
<!-- End Card -->
@endsection
