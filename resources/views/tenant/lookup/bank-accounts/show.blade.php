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
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Bank Account Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_name }}"  label="AC Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->ac_number }}" label="AC Number"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->bank_name }}" label="Bank Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->bank_name }}" label="Branch Name"/>
					<x-tenant.show.my-text		value="{{ $bankAccount->bank_name }}" label="Currency"/>
					<x-tenant.show.my-badge		value="{{ $bankAccount->id }}" label="ID"/>
					<x-tenant.show.my-boolean	value="{{ $bankAccount->enable }}"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date-time value="{{$bankAccount->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$bankAccount->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

