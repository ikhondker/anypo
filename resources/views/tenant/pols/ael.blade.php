@extends('layouts.app')
@section('title','Purchase Order Receipts')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Receipt for POL #{{ $pol->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pol"/>
			<x-tenant.buttons.header.create object="Pol"/>
			{{-- <a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a> --}}
			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('receipts.create',  $pol->id) }}"><i class="align-middle me-1" data-feather="layout"></i> Create Another Receipt</a>
					<a class="dropdown-item" href="{{ route('pos.show',  $pol->po_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>
					<div class="dropdown-divider"></div>
				</div>
			</div>

		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.pol-info id="{{ $pol->id }}"/>
	
	<x-tenant.accounting.for-po id="{{ $pol->po_id }}"/>


@endsection

