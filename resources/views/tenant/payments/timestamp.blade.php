@extends('layouts.tenant.app')
@section('title','View Payment')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$payment->invoice->po_id) }}" class="text-muted">PO#{{ $payment->invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $payment->invoice->po_id) }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $payment->invoice->id) }}" class="text-muted">#{{ $payment->invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">PAY#{{ $payment->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Payment
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists model="Payment"/>
			<x-tenant.actions.payment-actions paymentId="{{ $payment->id }}"/>

		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.who-when model="Payment" articleId="{{ $payment->id  }}"/>

	<x-tenant.widgets.back-to-list model="Payment"/>



@endsection

