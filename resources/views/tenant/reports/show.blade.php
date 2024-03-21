@extends('layouts.app')
@section('title','View Report')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Report
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Report"/>
			<x-tenant.buttons.header.create object="Report"/>
			<x-tenant.buttons.header.edit object="Report" :id="$report->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Report Info</h5>
				</div>
				<div class="card-body">
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
				</div>

				<!-- Footer -->
				@if ( auth()->user()->isSystem() )
				<div class="card-footer pt-0">
					<div class="d-flex justify-content-end gap-3">
						<a class="btn btn-danger" href="{{ route('reports.edit',$report->id) }}"><i data-feather="edit"></i> Edit</a>
					</div>
				</div>
				<!-- End Footer -->
				@endif

			</div>
		</div>
		<!-- end col-6 -->
		
	</div>
	<!-- end row -->

@endsection

