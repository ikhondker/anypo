@extends('layouts.landlord-app')
@section('title','My Account')
@section('breadcrumb','My Account')
@inject('carbon', 'Carbon\Carbon')

@section('content')

<!-- Card -->
<div class="card">

	
	<x-landlord.widget.expire-warning/>

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
				@forelse ($accounts as $account)
				<tr>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" alt="{{ $account->name }}" title="{{ $account->name }}">
							</div>

							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="{{ route('accounts.show',$account->id) }}">
									<h6 class="text-hover-primary mb-0">{{ $account->name }} [{{ $account->site }}]</h6>
								</a>
								<small class="d-block">ID: #{{ $account->id }} </small>
								{{-- <small class="d-block">Owner: {{ $account->owner->name }} </small> --}}
							</div>
						</div>
					</td>
					<td><x-landlord.list.my-date :value="$account->start_date" /></td>
					<td><x-landlord.list.my-date :value="$account->end_date" /></td>
					<td><span class="badge bg-primary rounded-pill">{{ $account->user }}</span></td>	
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

	<x-landlord.widget.add-addon/> 

</div>
<!-- End Card -->

@include('shared.includes.js.sw2-advance')

@endsection
