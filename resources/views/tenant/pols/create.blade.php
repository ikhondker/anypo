@extends('layouts.app')
@section('title','Add PO Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}">{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Add PO Line</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add PO Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>

	<!-- form start -->
	<form action="{{ route('pols.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<!-- widget-pol-card -->
		<x-tenant.widgets.pol.card :po="$po" :readOnly="false" :addMore="true">
			@slot('lines')
				<tbody>
					@forelse($pols as $pol)
						<x-tenant.widgets.pol.card-table-row :line="$pol" :status="$po->auth_status"/>
					@empty

					@endforelse
					@include('tenant.includes.po.po-line-add')
				</tbody>
			@endslot
		</x-tenant.widgets.pol.card>
		<!-- /.widget-pol-card -->


	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')

@endsection

