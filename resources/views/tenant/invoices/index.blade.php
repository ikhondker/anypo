@extends('layouts.tenant.app')
@section('title','Invoice Lists')
@section('breadcrumb')
	<li class="breadcrumb-item active">Invoices</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Invoice Lists
		@endslot
		@slot('buttons')
			<a href="{{ route('invoices.create-for-po') }}" class="btn btn-primary me-2"><i data-lucide="plus"></i> Create</a>
			<x-tenant.actions.invoice-actions-index/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					 <x-tenant.card.header-search-export-xls entity="Invoice"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
						@else
							Invoice Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Invoices.</h6>
				</div>
				<div class="card-body">

					<!-- ========== INCLUDE ========== -->
					@include('tenant.includes.invoice.invoice-lists-table')
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

