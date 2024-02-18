@extends('layouts.app')
@section('title','Purchase Order Invoice')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Invoices for PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
			<x-tenant.buttons.header.create object="Po"/>
			{{-- <a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a> --}}
			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{ route('pos.show',  $po->id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>
					<a class="dropdown-item" href="{{ route('invoices.create',$po->id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Create Another Invoice</a>
					<div class="dropdown-divider"></div>
				</div>
			</div>

		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.po-info id="{{ $po->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<x-tenant.widgets.po.invoices :id="$po->id" />

	

@endsection

