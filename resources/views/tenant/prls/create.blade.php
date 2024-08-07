@extends('layouts.tenant.app')
@section('title','Add Requisition Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Add New Line</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add Requisition Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.widgets.pr.show-pr-header id="{{ $pr->id }}"/>

	<!-- form start -->
	<form action="{{ route('prls.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<!-- widget-prl-cards -->
		<x-tenant.widgets.prl.card :pr="$pr" :readOnly="false" :addMore="true">
			@slot('lines')
				<tbody>
					@forelse ($prls as $prl)
						<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>
					@empty

					@endforelse
					@include('tenant.includes.pr.pr-line-add')
				</tbody>
			@endslot
		</x-tenant.widgets.prl.card>
		<!-- /.widget-prl-cards -->
	
	</form>
	<!-- /.form end -->
	
	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')
	
@endsection

