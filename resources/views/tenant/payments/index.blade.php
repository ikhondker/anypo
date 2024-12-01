@extends('layouts.tenant.app')
@section('title','Payments')
@section('breadcrumb')
	<li class="breadcrumb-item active">Payments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Payment Lists
		@endslot
		@slot('buttons')
			<a href="{{ route('payments.create-for-invoice') }}" class="btn btn-primary float-end me-2"><i data-lucide="plus"></i> Create</a>
			<x-tenant.actions.payment-actions-index/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-bar object="Payment"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Payment Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Payments.</h6>
				</div>
				<div class="card-body">
					<!-- ========== INCLUDE ========== -->
					@include('tenant.includes.payment.payment-lists-table')
					<!-- ========== INCLUDE ========== -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->



@endsection

