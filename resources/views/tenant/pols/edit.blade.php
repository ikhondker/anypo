@extends('layouts.tenant.app')
@section('title','Edit Purchase Order Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Edit PO Line # {{ $pol->line_num }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Purchase Order Line
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.pol-actions id="{{ $pol->id }}"/>
		
		@endslot
	</x-tenant.page-header>
	

	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>

	<!-- form start -->
	<form action="{{ route('pols.update',$pol->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- widget-pol-card -->
		<x-tenant.widgets.pol.card :po="$po" :readOnly="false" :addMore="true">
			@slot('lines')
				<tbody>
					@forelse($pols as $poln)
						@if ( $poln->id == $pol->id )
							@include('tenant.includes.po.po-line-edit')
						@else
							<x-tenant.widgets.pol.card-table-row :line="$poln" :status="$po->auth_status"/>
						@endif 
					@empty

					@endforelse
				</tbody>
			@endslot
		</x-tenant.widgets.pol.card>
		<!-- /.widget-pol-card -->
	
	</form>
	<!-- /.form end -->

	 @include('tenant.includes.js.select2')

@endsection

