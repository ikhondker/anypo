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
			<x-tenant.buttons.header.lists object="Invoice" label="Invoice"/>
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.invoice-info invoiceId="{{ $invoice->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::INVOICE->value }}" articleId="{{ $invoice->id }}"/>

    <div class="row">
		<div class="col-sm-6">
			@if ($invoice->status == App\Enum\InvoiceStatusEnum::DRAFT->value)
				<form action="{{ route('invoices.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="attach_invoice_id" id="attach_invoice_id" class="form-control" placeholder="ID" value="{{ old('id', $invoice->id ) }}" hidden>
					<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
					<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false"><i class="align-middle me-1" data-lucide="paperclip"></i> Add Attachment</a>
				</form>
				<!-- /.form end -->
			@endif
		</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('invoices.show', $invoice->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PR</a>
		</div>
	</div>

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>

@endsection

