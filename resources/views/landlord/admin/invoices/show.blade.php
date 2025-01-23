@extends('layouts.landlord.app')
@section('title','View Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item active">{{ $invoice->invoice_no }}</li>
@endsection

@section('content')

	<x-landlord.page-header>
		@slot('title')
			Invoice #{{ $invoice->invoice_no }}
		@endslot
		@slot('buttons')
				@if (auth()->user()->isBackend())
					<x-landlord.actions.invoice-actions-support invoiceId="{{ $invoice->id }}"/>
				@endif
				<a href="{{ route('invoices.index') }}" class="btn btn-primary float-end me-1"><i data-lucide="database"></i> View all</a>
				<a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-1"><i data-lucide="plus"></i> New Ticket</a>
		@endslot
	</x-landlord.page-header>

	@include('landlord.includes.invoice')

	@if (auth()->user()->isSys())
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					@if (auth()->user()->isSys())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('invoices.edit', $invoice->id) }}"><i data-lucide="edit"></i> Edit(*)</a>
					@endif
				</div>
				<h5 class="card-title text-danger">View Invoice (Confidential) </h5>
				<h6 class="card-subtitle text-muted">Confidential Invoice Detail.</h6>
			</div>
			<div class="card-body">
				<div class="row pt-5">
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-sm mb-0">
								<tbody>
									<tr>
										<th class="text-danger">Discount % :</th>
										<td>{{ number_format($invoice->discount, 2) }}</td>
									</tr>
									<x-landlord.show.my-date value="{{ $invoice->discount_date }}" label="Discount Date" />
									<x-landlord.show.my-text value="{{ $invoice->discount_by }}" label="Discount By" />
                                    <x-landlord.show.my-enable value="{{ $invoice->posted }}" label="{{ 'Posted' }}" />
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-sm mb-0">
								<tbody>
									<tr>
										<th>Pay Without Payment ?</th>
										<td><span class="badge {{ ($invoice->pwop ? 'badge-subtle-danger' : 'badge-subtle-success') }}">{{ ($invoice->pwop ? 'Yes' : 'No') }}</span></td>
									</tr>
									<x-landlord.show.my-date value="{{ $invoice->pwop_date }}" label="Pwop Date" />
									<x-landlord.show.my-text value="{{ $invoice->pwop_paid_by }}" label="Pwop By" />
									<x-landlord.show.my-text-area value="{{ $invoice->notes_internal }}" label="Internal Notes" />
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

@endsection
