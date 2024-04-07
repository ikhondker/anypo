@extends('layouts.landlord-app')
@section('title','My Account')
@section('breadcrumb','All Accounts')


@section('content')
<!-- Card -->
<div class="card">
	<div class="card-header">
		<h5 class="card-header-title">All Accounts</h5>
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
				@foreach ($accounts as $account)
				<tr>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}"  alt="{{ $account->name }}" title="{{ $account->name }}">
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
					<td><span class="badge bg-primary rounded-pill">{{ $account->user }}</span></td>	
					<td><x-landlord.list.my-number :value="$account->price"/>$</td>
					<td><x-landlord.list.my-badge :value="$account->status->name" badge="{{ $account->status->badge }}" /></td>
					<td><x-landlord.list.actions object="Account" :id="$account->id" :export="false" :enable="false" /></td>
				</tr>

				@endforeach
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
