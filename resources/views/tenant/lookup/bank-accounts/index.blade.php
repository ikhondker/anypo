@extends('layouts.app')
@section('title','Bank Accounts')

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
		<div class="col-8">

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
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>AC Name</th>
								<th>AC Number</th>
								<th>Bank Name</th>
								<th>Currency</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($bank_accounts as $bank_account)
							<tr>
								<td>{{ $bank_accounts->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('bank-accounts.show',$bank_account->id) }}">{{ $bank_account->ac_name }}</a></td>
								<td>{{ $bank_account->ac_number }}</td>
								<td>{{ $bank_account->bank_name }}</td>
								<td>{{ $bank_account->currency }}</td>
								<td><x-tenant.list.my-boolean :value="$bank_account->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="BankAccount" :id="$bank_account->id"/>
									<a href="{{ route('bank-accounts.destroy', $bank_account->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="BankAccount" data-name="{{ $bank_account->ac_name }}" data-status="{{ ($bank_account->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($bank_account->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($bank_account->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $bank_accounts->links() }}
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

	@include('tenant.includes.modal-boolean-advance')
	
@endsection

