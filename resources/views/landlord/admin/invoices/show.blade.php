@extends('layouts.landlord-app')
@section('title','View Invoice')
@section('breadcrumb','View Invoice')

@section('content')
	<!-- Card -->
	<div class="card">
			<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
				<h5 class="card-header-title">View Invoice #{{ $invoice->invoice_no }}</h5>
				@if ($invoice->status_code->value == App\Enum\LandlordInvoiceStatusEnum::DUE->value) 
					<form action="{{ url('/payment') }}" method="POST" class="needs-validation">
						<input type="hidden" value="{{ csrf_token() }}" name="_token" />
						<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
						<button class="btn btn-primary btn-sm" type="submit">
							<i class="bi bi-plus-square me-1"></i>Pay Invoice (Hosted)
						</button>
					</form>    
				@endif	
			</div>

			<!-- Body -->
			<div class="card-body">
					<x-landlord.show.my-text     value="{{ $invoice->invoice_no }}" label="Invoice No"/>
					<x-landlord.show.my-date value="{{ $invoice->invoice_date }}" label="Invoice Date"/>
					<x-landlord.show.my-badge     value="{{ $invoice->status->name }}" badge="{{ $invoice->status->badge }}" label="Status"/>

					<x-landlord.show.my-text     value="{{ $invoice->summary }}" label="Particulars"/>
					<x-landlord.show.my-date value="{{ $invoice->from_date }}" label="From Date"/>
					<x-landlord.show.my-date value="{{ $invoice->to_date }}" label="To Date"/>
							
					{{-- <x-landlord.show.my-text     value="{{  $invoice->account->name }}" label="Account"/>
					<x-landlord.show.my-badge    value="{{ $invoice->id }}" label="ID"/>
											 --}}
					<x-landlord.show.my-number value="{{  $invoice->price }}" label="Amount"/>
					<x-landlord.show.my-number value="{{  $invoice->amount_paid }}" label="Amount Paid"/>
					
					<x-landlord.show.my-date value="{{ $invoice->created_at }}" label="Created At:"/>
			</div>
			<!-- End Body -->

			<!-- Footer -->
			<div class="card-footer pt-0">
					<div class="d-flex justify-content-end gap-3">
						<a class="btn btn-primary" href="{{ route('users.edit',$invoice->id) }}">Edit</a>
					</div>
			</div>
			<!-- End Footer -->
	</div>
	<!-- End Card -->
@endsection
