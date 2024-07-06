@extends('layouts.tenant.app')
@section('title','Receipt Lists')
@section('breadcrumb')
	<li class="breadcrumb-item active">Receipts</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Receipt Lists
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="Receipt"/> --}}
			<x-tenant.actions.receipt-actions-index/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-bar object="Receipt"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Receipt Lists
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

