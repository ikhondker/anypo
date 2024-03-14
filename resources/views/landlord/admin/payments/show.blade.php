@extends('layouts.landlord-app')
@section('title','View Payment')

@section('breadcrumb','View Payment')

@section('content')

				<!-- Card -->
				<div class="card">
						<div class="card-header border-bottom">
								<h4 class="card-header-title">View Payment</h4>
						</div>

						<!-- Body -->
						<div class="card-body">
								<x-landlord.show.my-badge	value="{{ $payment->id }}" label="Payment ID"/>
								<x-landlord.show.my-date	value="{{ $payment->pay_date }}"/>
								<x-landlord.show.my-number	value="{{ $payment->amount }}"/>
								<x-landlord.show.my-text	value="{{ $payment->invoice->invoice_no }}" label="Invoice #"/>
								<x-landlord.show.my-text	value="{{ $payment->cheque_no  }}" label="Cheque#"/>
								<x-landlord.show.my-text	value="{{  $payment->summary}}" label="Summary"/>
								<x-landlord.show.my-text	value="{{ $payment->reference_id }}" label="Reference"/>
								<x-landlord.show.my-badge	value="{{ $payment->status->name }}" badge="{{ $payment->status->badge }}" label="Status"/>

						</div>
						<!-- End Body -->

						@if (auth()->user()->isSystem())
							<!-- Footer -->
							<div class="card-footer pt-0">
								<div class="d-flex justify-content-end gap-3">
									<a class="btn btn-danger" href="{{ route('payments.edit', $payment->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
								</div>
							</div>
							<!-- End Footer -->
						@endif 
				</div>
				<!-- End Card -->


@endsection

