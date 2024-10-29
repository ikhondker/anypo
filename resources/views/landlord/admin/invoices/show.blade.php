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

@endsection
