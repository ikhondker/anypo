@extends('layouts.tenant.app')
@section('title','Bank Accounts')
@section('breadcrumb')
	<li class="breadcrumb-item active">Bank Accounts</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Bank Accounts
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="BankAccount"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.cards.header-search-export-bar object="BankAccount"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Bank Accounts
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of Bank Accounts.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>AC Name</th>
						<th>AC Number</th>
						<th>Routing #</th>
						<th>Bank Name</th>
						<th>Currency</th>
						<th>Enable</th>
						<th class="text-middle">View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($bankAccounts as $bankAccount)
					<tr>
						<td>{{ $bankAccounts->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('bank-accounts.show',$bankAccount->id) }}"><strong>{{ $bankAccount->ac_name }}</strong></a></td>
						<td>{{ $bankAccount->ac_number }}</td>
						<td>{{ $bankAccount->routing_number }}</td>
						<td>{{ $bankAccount->bank_name }}</td>
						<td>{{ $bankAccount->currency }}</td>
						<td><x-tenant.list.my-boolean :value="$bankAccount->enable"/></td>
						<td>
							<a href="{{ route('bank-accounts.show',$bankAccount->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $bankAccounts->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

