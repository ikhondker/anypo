@extends('layouts.tenant.app')
@section('title','My Receipt Lists')
@section('breadcrumb')
	<li class="breadcrumb-item active">My Receipts</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			My Receipt Lists
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create model="Receipt"/> --}}
			<x-tenant.actions.receipt-actions-index/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-bar model="Receipt"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
						@else
							My Receipt Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Goods Receipts.</h6>
				</div>
				<div class="card-body">

					<!-- ========== INCLUDE ========== -->
					@include('tenant.includes.receipt.receipt-lists-table')
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

