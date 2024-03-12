@extends('layouts.landlord-app')
@section('title','My Account')
@section('breadcrumb','My Account')


@section('content')
<!-- Card -->
<div class="card">
	<div class="card-header">
		<h5 class="card-header-title">Your Billing Account</h5>
	</div>

	<!-- Table -->
	<div class="table-responsive">
		<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
			<thead class="thead-light">
				<tr>
					<th>Name</th>
					<th>Start</th>
					<th>End</th>
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


	<!-- card-body -->
	<div class="card-body">
		<!-- pagination -->
		{{ $accounts->links() }}
		<!--/. pagination -->
	</div>
	<!-- /. card-body -->

</div>
<!-- End Card -->
@endsection


@section('bo04-content')

<!-- my-section-table -->
<div class="table-responsive bg-white shadow rounded">
	<table class="table mb-0 table-center">
		<thead>
			<tr>
				<th class="">#</th>
				<th class="">Name</th>
				<th class="">Owner</th>
				<th class="">From</th>
				<th class="">To</th>
				<th class="text-center">Status</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($accounts as $account)
			<tr class="">
				<td class="">
					<x-landlord.list.my-id-link object="Account" :id="$account->id" />
				</td>
				<td class="">{{ $account->name }}</td>
				<td class="">{{ $account->owner->name }}</td>
				<td class="">
					<x-landlord.list.my-date :value="$account->start_date" />
				</td>
				<td class="">
					<x-landlord.list.my-date :value="$account->end_date" />
				</td>
				<td class="text-center">
					<x-landlord.list.my-badge :value="$account->status" />
				</td>
				<td class="text-center">
					<x-landlord.list.actions object="Account" :id="$account->id" :export="false" :enable="false" />
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<!--/. my-section-table -->

<!-- my-pagination -->
<div class="row pt-3">
	{{ $accounts->links() }}
</div>
<!--/. my-pagination -->

@endsection