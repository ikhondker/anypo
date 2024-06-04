@extends('layouts.app')
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
			{{-- <x-tenant.buttons.header.create object="Payment"/> --}}
            <x-tenant.actions.payment-actions-index/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Payment"/>
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

