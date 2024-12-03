@extends('layouts.tenant.app')
@section('title','Accountings for Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}" class="text-muted">Receipts</a></li>
	<li class="breadcrumb-item active">GRN#{{ $receipt->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Accounting for Receipt #{{ $receipt->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Invoice" label="Receipt"/>
			{{-- <x-tenant.buttons.header.create model="Invoice" label="Requisition"/> --}}
			<x-tenant.actions.receipt-actions receiptId="{{ $receipt->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.receipt-info receiptId="{{ $receipt->id }}"/>

	<x-tenant.ael.ael-for-receipt receiptId="{{ $receipt->id }}"/>

@endsection

