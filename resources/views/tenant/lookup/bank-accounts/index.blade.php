@extends('layouts.app')
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

	<div class="row">
		<div class="col-12">

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
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($bankAccounts as $bankAccount)
							<tr>
								<td>{{ $bankAccounts->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('bank-accounts.show',$bankAccount->id) }}">{{ $bankAccount->ac_name }}</a></td>
								<td>{{ $bankAccount->ac_number }}</td>
								<td>{{ $bankAccount->routing_number }}</td>
								<td>{{ $bankAccount->bank_name }}</td>
								<td>{{ $bankAccount->currency }}</td>
								<td><x-tenant.list.my-boolean :value="$bankAccount->enable"/></td>
								<td class="table-action">
									<a href="{{ route('bank-accounts.show',$bankAccount->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i></a>
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

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	
	
@endsection

