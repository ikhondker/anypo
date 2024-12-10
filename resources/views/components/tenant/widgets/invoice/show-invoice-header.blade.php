<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('reports.invoice', $invoice->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-lucide="printer"></i></a>
					@if ($invoice->status == App\Enum\Tenant\InvoiceStatusEnum::DRAFT->value)
						@can('update', $invoice)
							<a href="{{ route('invoices.edit', $invoice->id ) }}" class="btn btn-sm btn-light"><i data-lucide="edit"></i> Edit</a>
						@endcan
					@endif
				</div>
				<h5 class="card-title">Basic Information for Invoice #{{ $invoice->id }}</h5>
				<h6 class="card-subtitle text-muted">Key information of a Purchase Invoice</h6>
			</div>
			<div class="card-body">

				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th width="20%">Invoice Num #:</th>
							<td><strong>{{ $invoice->invoice_no }}</strong></td>
						</tr>
						<x-tenant.show.my-date		value="{{ $invoice->invoice_date }}" label="Invoice Date"/>
						<x-tenant.show.my-text		value="{{ $invoice->supplier->name }}" label="Supplier"/>
						<tr>
							<th>Invoice Amount :</th>
							<td>
								{{number_format($invoice->amount, 2)}}<span class="badge badge-subtle-primary">{{ $invoice->currency }}</span>
								@if ($invoice->currency <> $_setup->currency)
									{{number_format($invoice->fc_amount, 2)}}<span class="badge badge-subtle-success">{{ $invoice->fc_currency }}</span>
								@endif
							</td>
						</tr>
						<x-tenant.show.my-text		value="{{ $invoice->summary }}" label="Narration"/>
						<x-tenant.show.my-number	value="{{ $invoice->sub_total }}" label="Sub Total"/>
						<x-tenant.show.my-number	value="{{ $invoice->tax }}" label="Tax"/>
						<x-tenant.show.my-number	value="{{ $invoice->gst }}" label="GST"/>
						<tr>
							<th>&nbsp;</th>
							<td>
								@if ($invoice->status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
									<x-tenant.show.my-edit-link model="Pr" :id="$invoice->id"/>
								@endif
							</td>
						</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
	<div class="col-6">
		<div class="card">
			<div class="card-header">

				<div class="card-actions float-end">
					@can('post', $invoice)
						<a href="{{ route('invoices.post', $invoice->id) }}" class="btn btn-warning text-white float-end me-2 sw2-advance"
							data-entity="" data-name="INV#{{ $invoice->id }}" data-status="Post Invoice"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Post Invoice">
							<i data-lucide="external-link" class="text-white"></i> Post</a>
					@else
						<span class="badge {{ $invoice->status_badge->badge }}">{{ $invoice->status_badge->name}}</span>
					@endcan
				</div>
				<h5 class="card-title">Other Information</h5>
				<h6 class="card-subtitle text-muted">Others information about Purchase Invoice.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
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
							<td><x-tenant.attachment.all entity="INVOICE" articleId="{{ $invoice->id }}"/></td>
						</tr>

						<tr>
							<th>&nbsp;</th>
							<td>
								@if ($invoice->status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
									<form action="{{ route('invoices.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
										@csrf
										{{-- <x-tenant.attachment.create /> --}}
										<input type="text" name="attach_invoice_id" id="attach_invoice_id" class="form-control" placeholder="ID" value="{{ old('id', $invoice->id ) }}" hidden>
										<div class="row">
											<div class="col-sm-3 text-end">

											</div>
											<div class="col-sm-9 text-end">
												<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
												<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
												{{-- <x-show.my-edit-link object="Pr" :id="$invoice->id"/> --}}
											</div>
										</div>
										{{-- <x-buttons.submit/> --}}
									</form>
									<!-- /.form end -->
								@endif
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->

<script type="text/javascript">
	function mySubmit() {
		//alert('I am inside 2');
		//document.getElementById('upload').click();
		document.getElementById('frm1').submit();
	}
</script>
