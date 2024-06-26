@extends('layouts.landlord.app')
@section('title','View Payment')
@section('breadcrumb','View Payment')

@section('content')

	<h1 class="h3 mb-3">View Payment</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('payments.index') }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i>  View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('payments.edit', $payment->id) }}"><i class="fas fa-edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Payment</h5>
					<h6 class="card-subtitle text-muted">View Payment Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge	value="{{ $payment->id }}" label="Payment ID"/>
							<x-landlord.show.my-date	value="{{ $payment->pay_date }}"/>
							<x-landlord.show.my-number	value="{{ $payment->amount }}"/>
							<x-landlord.show.my-text	value="{{ $payment->invoice->invoice_no }}" label="Invoice #"/>
							<x-landlord.show.my-text	value="{{ $payment->cheque_no }}" label="Cheque#"/>
							<x-landlord.show.my-text	value="{{ $payment->summary}}" label="Summary"/>
							<x-landlord.show.my-text	value="{{ $payment->reference_id }}" label="Reference"/>
							<x-landlord.show.my-badge	value="{{ $payment->status->name }}" badge="{{ $payment->status->badge }}" label="Status"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection

