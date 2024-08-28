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
				@if ($invoice->status == App\Enum\InvoiceStatusEnum::DRAFT->value)
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


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@if ($invoice->status == App\Enum\InvoiceStatusEnum::DRAFT->value)
					@can('update', $invoice)
						<a href="{{ route('invoices.edit', $invoice->id ) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
					@endcan
				@endif
				<a href="{{ route('invoices.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Invoice Detail</h5>
			<h6 class="card-subtitle text-muted">Invoice Detail Information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<tr>
						<th>Invoice Num #:</th>
						<td><strong>{{ $invoice->invoice_no }}</strong></td>
					</tr>
					<x-tenant.show.my-date		value="{{ $invoice->invoice_date }}" label="Invoice Date"/>
					<x-tenant.show.my-text		value="{{ $invoice->supplier->name }}" label="Supplier"/>
					<x-tenant.show.my-amount-currency	value="{{ $invoice->amount }}" currency="{{ $invoice->currency }}" label="Invoice Amount"/>
					<x-tenant.show.my-text		value="{{ $invoice->summary }}" label="Narration"/>
					<x-tenant.show.my-number	value="{{ $invoice->sub_total }}" label="Sub Total"/>
					<x-tenant.show.my-number	value="{{ $invoice->tax }}" label="Tax"/>
					<x-tenant.show.my-number	value="{{ $invoice->gst }}" label="GST"/>
					<tr>
						<th>PO #:</th>
						<td>
							<a class="text-muted" href="{{ route('pos.show',$invoice->po_id) }}">
								{{ "#". $invoice->po_id. " - ". $invoice->po->summary }}
							</a>
						</td>
					</tr>
					<x-tenant.show.my-text		value="{{ $invoice->poc->name }}" label="PoC Name"/>
					<x-tenant.show.my-amount-currency	value="{{ $invoice->amount_paid }}" currency="{{ $invoice->currency }}" label="Paid Amount"/>
					<x-tenant.show.my-badge		value="{{ $invoice->status }}" label="Status"/>
					<x-tenant.show.my-badge		value="{{ $invoice->payment_status }}" label="Payment Status"/>
					<x-tenant.show.my-text-area	value="{{ $invoice->notes }}"/>
					<tr>
						<th>Created By:</th>
						<td>{{ $invoice->createdBy->name }}</td>
					</tr>
					<tr>
						<th>Attachments</th>
						<td><x-tenant.attachment.all entity="INVOICE" aid="{{ $invoice->id }}"/></td>
					</tr>

					<tr>
						<th></th>
						<td>
							@if ($invoice->status == App\Enum\InvoiceStatusEnum::DRAFT->value)
								@can('edit', $invoice)
									<form action="{{ route('invoices.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
										@csrf
										{{-- <x-tenant.attachment.create /> --}}
										<input type="text" name="attach_invoice_id" id="attach_invoice_id" class="form-control" placeholder="ID" value="{{ old('attach_invoice_id', $invoice->id ) }}" hidden>
										<div class="row">
											<div class="col-sm-3 text-end">

											</div>
											<div class="col-sm-9 text-end">
												<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
												<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
												{{-- <x-show.my-edit-link object="Pr" :id="$pr->id"/> --}}
											</div>
										</div>
										{{-- <x-buttons.submit/> --}}
									</form>
									<!-- /.form end -->
								@endcan
							@endif
						</td>
					</tr>

				</tbody>
			</table>

		</div>
	</div>

	<x-tenant.widgets.invoice.show-invoice-header invoiceId="{{ $invoice->id }}"/>

	<x-tenant.widgets.po.invoice-payments :iid="$invoice->id" />

	<script type="text/javascript">
		function mySubmit() {
			//alert('I am inside 2');
			//document.getElementById('upload').click();
			document.getElementById('frm1').submit();
		}
	</script>
@endsection

