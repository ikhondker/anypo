@extends('layouts.tenant.app')
@section('title','View Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}" class="text-muted">Receipts</a></li>
	<li class="breadcrumb-item active">GRN#{{ $receipt->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Receipt"/>
			<x-tenant.actions.receipt-actions receiptId="{{ $receipt->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.who-when model="Receipt" articleId="{{ $receipt->id  }}"/>

	<x-tenant.widgets.back-to-list model="Receipt"/>


@endsection

