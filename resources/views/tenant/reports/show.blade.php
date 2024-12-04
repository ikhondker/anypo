@extends('layouts.tenant.app')
@section('title','View Report')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('reports.index') }}" class="text-muted">Reports</a></li>
	<li class="breadcrumb-item active">{{ $report->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Report
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Report"/>
			{{-- <x-tenant.buttons.header.create model="Report"/> --}}
			{{-- <x-tenant.buttons.header.edit model="Report" :id="$report->id"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@if ( auth()->user()->isSystem() )
					<a class="btn btn-sm btn-danger text-white" href="{{ route('reports.edit', $report->code ) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
					<a class="btn btn-sm btn-light" href="{{ route('reports.parameter', $report->code ) }}"><i class="fas fa-print"></i> Run</a>


			</div>
			<h5 class="card-title">Reports Detail</h5>
			<h6 class="card-subtitle text-muted">Details of a Report.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-badge		value="{{ $report->id }}" label="ID"/>
					<x-tenant.show.my-text		value="{{ $report->name }}"/>
					<x-tenant.show.my-text		value="{{ $report->summary }}" label="Summary"/>
					<x-tenant.show.my-badge		value="{{ $report->access }}" label="Access"/>
					<x-tenant.show.my-boolean	value="{{ $report->article_id }}" label="Article ID?"/>
					<x-tenant.show.my-boolean	value="{{ $report->start_date }}" label="Start Date"/>
					<x-tenant.show.my-boolean	value="{{ $report->end_date }}" label="End Date"/>
					<x-tenant.show.my-boolean	value="{{ $report->user_id }}" label="User?"/>
					<x-tenant.show.my-boolean	value="{{ $report->item_id }}" label="Item?"/>
					<x-tenant.show.my-boolean	value="{{ $report->supplier_id }}" label="Supplier?"/>
					<x-tenant.show.my-boolean	value="{{ $report->project_id }}" label="Project?"/>
					<x-tenant.show.my-boolean	value="{{ $report->category_id }}" label="Category?"/>
					<x-tenant.show.my-boolean	value="{{ $report->dept_id }}" label="Dept?"/>
					<x-tenant.show.my-boolean	value="{{ $report->warehouse_id }}" label="Warehouse?"/>
					<x-tenant.show.my-boolean	value="{{ $report->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $report->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $report->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

