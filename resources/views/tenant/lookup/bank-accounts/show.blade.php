@extends('layouts.tenant.app')
@section('title','View Bank Account')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('bank-accounts.index') }}" class="text-muted">Bank Accounts</a></li>
	<li class="breadcrumb-item active">{{ $bankAccount->ac_name }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Bank Account
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.bank-account-actions bankAccountId="{{ $bankAccount->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('bank-accounts.edit', $bankAccount->id ) }}"><i data-lucide="edit"></i> Edit</a>
			</div>
			<h5 class="card-title">Bank Account Detail</h5>
			<h6 class="card-subtitle text-muted">Bank Account detail information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_name }}" label="AC Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_number }}" label="AC Number"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->routing_number }}" label="Routing Number"/>
					<x-tenant.show.my-currency	value="{{ $bankAccount->currency }}" label="Currency"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->bank_name }}" label="Bank Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->branch_name }}" label="Branch Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_cash }}" label="Cash GL Account"/>
					<x-tenant.show.my-boolean	value="{{ $bankAccount->enable }}"/>
					<x-tenant.show.my-text 		value="{{ $bankAccount->address1 }}" label="Address1"/>
					<x-tenant.show.my-text 		value="{{ $bankAccount->address2 }}" label="Address2"/>
					<x-tenant.show.my-text 		value="{{ $bankAccount->city.', '.$bankAccount->state.', '.$bankAccount->zip }}" label="City"/>
					<x-tenant.show.my-text 		value="{{ $bankAccount->relCountry->name }}" label="Country"/>
				</tbody>
			</table>
		</div>
	</div>

     <x-tenant.widgets.back-to-list model="BankAccount"/>

@endsection

