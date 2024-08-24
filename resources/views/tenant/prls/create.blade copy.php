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
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}" show="true"/>
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
	
		<tr>
			<th>&nbsp;</th>
			<td>
				<div class="float-end">
					<div class="form-check form-switch">
						<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
						<label class="form-check-label" for="add_row">... add another row </label>
						<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ url()->previous() }}"><i data-lucide="x-circle"></i> Back</a>
						<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
					</div>
				</div>
			</td>
		</tr>
		
	</form>
	<!-- /.form end -->
	
	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')
	
@endsection

