@extends('layouts.tenant.app')
@section('title','View Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item active">{{ $invoice->invoice_no}}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Invoice
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice"/>
			@can('post', $invoice)
				@if ($invoice->status == App\Enum\Tenant\InvoiceStatusEnum::DRAFT->value)
					<a href="{{ route('invoices.post', $invoice->id) }}" class="btn btn-primary float-end me-2 sw2-advance"
						data-entity="INVOICE #" data-name="{{ $invoice->id }}" data-status="Post"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Post Invoice">
						<i data-lucide="external-link"></i> Post Invoice</a>
				@endif
			@endcan
			{{-- <x-tenant.buttons.header.lists object="Po" label="Purchase Order"/> --}}
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}"/>

		@endslot
	</x-tenant.page-header>


	<x-tenant.widgets.invoice.show-invoice-header invoiceId="{{ $invoice->id }}"/>

	<x-tenant.widgets.invoice-line.list-all-lines invoiceId="{{ $invoice->id }}"/>

	<x-tenant.widgets.invoice.payments :invoiceId="$invoice->id" />

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>
@endsection

