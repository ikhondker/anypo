@extends('layouts.app')
@section('title','Accountings for Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">Receipts</a></li>
	{{-- <li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">TODO POL</a></li> --}}
	<li class="breadcrumb-item active">GRN#{{ $receipt->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Accountings for Receipt #{{ $receipt->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice" label="Receipt"/>
			{{-- <x-tenant.buttons.header.create object="Invoice" label="Requisition"/> --}}
			<x-tenant.actions.receipt-actions id="{{ $receipt->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.receipt-info id="{{ $receipt->id }}"/>


				
	<x-tenant.ael.ael-for-receipt id="{{ $receipt->id }}"/>

@endsection

