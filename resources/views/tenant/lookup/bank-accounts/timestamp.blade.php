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


	<x-tenant.widgets.who-when model="BankAccount" articleId="{{ $bankAccount->id }}"/>


	<x-tenant.widgets.back-to-list model="BankAccount"/>

@endsection

