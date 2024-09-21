@extends('layouts.landlord.app')
@section('title', 'My Services')
@section('breadcrumb')
	<li class="breadcrumb-item active">Services</li>
@endsection

@section('content')
	@inject('carbon', 'Carbon\Carbon')


	<x-landlord.page-header>
		@slot('title')
		Services & Add-ons
		@endslot
		@slot('buttons')
				<x-landlord.actions.account-actions/>
			
		@endslot
	</x-landlord.page-header>

	<x-landlord.widgets.account-services accountId="{{ auth()->user()->account_id }}"  />

	<x-landlord.widgets.add-addon/>

@endsection
