
@extends('layouts.tenant.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$invoice->po_id) }}" class="text-muted">PO#{{ $invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $invoice->po_id) }}" class="text-muted">PO Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">{{ $invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments Invoice #{{ $invoice->invoice_no }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Invoice" label="Invoice"/>
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.invoice-info invoiceId="{{ $invoice->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::INVOICE->value }}" articleId="{{ $invoice->id }}"/>

	<div class="row">
		<div class="col-sm-6">
			@if ($invoice->status == App\Enum\Tenant\InvoiceStatusEnum::DRAFT->value)
				<x-tenant.attachment.add entity="{{ EntityEnum::INVOICE->value }}" articleId="{{ $invoice->id }}"/>
			@endif
		</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('invoices.show', $invoice->id) }}"><i data-lucide="arrow-left-circle"></i> Back to Invoice</a>
		</div>
	</div>


@endsection

