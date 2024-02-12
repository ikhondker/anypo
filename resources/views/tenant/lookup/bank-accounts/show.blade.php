@extends('layouts.app')
@section('title','View Bank Account')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Bank Account
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="BankAccount"/>
			<x-tenant.buttons.header.create object="BankAccount"/>
			<x-tenant.buttons.header.edit object="BankAccount" :id="$bankAccount->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Bank Account Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_name }}"  label="AC Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_number }}" label="AC Number"/>
					<x-tenant.show.my-currency	value="{{ $bankAccount->currency }}" label="Currency"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->bank_name }}" label="Bank Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->branch_name }}" label="Branch Name"/>
					<x-tenant.show.my-boolean	value="{{ $bankAccount->enable }}"/>
					<x-tenant.show.my-created_at value="{{$bankAccount->created_at }}"/>
					<x-tenant.show.my-updated_at value="{{$bankAccount->updated_at }}"/>
					<x-tenant.buttons.show.edit object="BankAccount" :id="$bankAccount->id"/>
		
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

