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
				@if (auth()->user()->isSeeded())
					<x-landlord.actions.invoice-actions-support invoiceId="{{ $invoice->id }}"/>
				@endif
                <a href="{{ route('invoices.index') }}" class="btn btn-primary float-end me-1"><i class="fas fa-list"></i> View all</a>
				<a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> New Ticket</a>
		@endslot
	</x-landlord.page-header>

    @include('landlord.includes.invoice')


    @if (auth()->user()->isSystem())
        <div class="card">
            <div class="card-header">
                <div class="card-actions float-end">
                    @if (auth()->user()->isSystem())
                        <a class="btn btn-sm btn-danger text-white" href="{{ route('invoices.edit', $invoice->id) }}"><i class="fas fa-edit"></i> Edit(*)</a>
                    @endif
                </div>
                <h5 class="card-title text-danger">View Invoice (Confidential) </h5>
                <h6 class="card-subtitle text-muted">Confidential Invoice Detail.</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm my-2">
                    <tbody>
                        <x-landlord.show.my-number value="{{ $invoice->discount }}" label="Discount %" />
                        <x-landlord.show.my-date value="{{ $invoice->discount_date }}" label="Discount Date"  />
                        <x-landlord.show.my-text value="{{ $invoice->discount_by }}" label="Discount By" />
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
    @endif

@endsection
