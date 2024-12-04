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

	{{-- <x-tenant.info.invoice-info paymentId="{{ $payment->invoice_id }}"/> --}}


			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a class="btn btn-sm btn-light" href="{{ route('reports.payment', $payment->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-lucide="printer"></i></a>
						@can('createForInvoice', App\Models\Tenant\Payment::class)
							<a href="{{ route('payments.create-for-invoice', $payment->invoice_id) }}" class="btn btn-sm btn-light"><i data-lucide="edit"></i> Make Another Payment</a>
						@endcan
						<a href="{{ route('payments.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
					</div>

					<h5 class="card-title">Payment Information</h5>
					<h6 class="card-subtitle text-muted">Payment Information Details.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-text		value="{{ $payment->id }}" label="Payment Number"/>
							<x-tenant.show.my-date		value="{{ $payment->pay_date }}"/>
							<x-tenant.show.my-amount-currency	value="{{ $payment->amount }}" currency="{{ $payment->currency }}" label="Payment Amount"/>
							<x-tenant.show.my-text		value="{{ $payment->bank_account->ac_name }}" label="Bank Ac"/>
							<x-tenant.show.my-text		value="{{ $payment->cheque_no }}" label="Ref/Cheque#"/>
							<x-tenant.show.my-text		value="{{ $payment->payee->name }}" label="Payee"/>
							<x-tenant.show.my-text		value="{{ $payment->invoice->supplier->name }}" label="Supplier"/>
							<tr>
								<th>Invoice #:</th>
								<td>
									<a class="text-muted" href="{{ route('invoices.show',$payment->invoice_id) }}">
										<strong>{{ $payment->invoice->invoice_no }}</strong>
									</a>
								</td>
							</tr>
							<x-tenant.show.my-amount-currency	value="{{ $payment->invoice->amount }}" currency="{{ $payment->currency }}" label="Invoice Amount"/>
							<tr>
								<th>PO #:</th>
								<td>
									<a class="text-muted" href="{{ route('pos.show',$payment->invoice->po_id) }}">
										{{ "#". $payment->invoice->po_id. " - ". $payment->invoice->po->summary }}
									</a>
								</td>
							</tr>
							<x-tenant.show.my-badge		value="{{ $payment->status }}" label="Payment Status"/>
							<x-tenant.show.my-text-area		value="{{ $payment->notes }}" label="Notes"/>
							<tr>
								<th>Attachments</th>
								<td><x-tenant.attachment.all entity="PAYMENT" articleId="{{ $payment->id }}"/></td>
							</tr>
						</div>
					</tbody>
				</table>
			</div>



@endsection

