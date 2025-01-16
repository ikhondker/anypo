@extends('layouts.tenant.app')
@section('title','Budget Usages')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('dbus.index') }}" class="text-muted">Budget Usages</a></li>
	<li class="breadcrumb-item active">{{ $dbu->id }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budget Usages
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('dbus.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				@if (auth()->user()->isSystem())
					<a class="btn btn-sm btn-danger text-white" href="{{ route('dbus.edit', $dbu->id) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
			</div>
			<h5 class="card-title">Budget Usages Information </h5>
			<h6 class="card-subtitle text-muted">Basic information about this Budget Usages.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $dbu->id }}" label="Transaction ID"/>
					<x-tenant.show.my-text		value="{{ $dbu->deptBudget->budget->name }}" label="Budget Name"/>
					<x-tenant.show.my-text		value="{{ $dbu->deptBudget->budget->fy }}" label="FY"/>
					<x-tenant.show.my-text		value="{{ $dbu->dept->name }}" label="Dept"/>
					<x-tenant.show.my-date		value="{{ $dbu->created_at }}" label="Date"/>
					<x-tenant.show.article-link entity="{{ $dbu->entity }}" :id="$dbu->article_id"/>
					<x-tenant.show.my-badge		value="{{ $dbu->event }}" label="Event"/>
					<x-tenant.show.project-link id="{{ $dbu->project_id }}" :label="$dbu->project->name"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_pr_booked }}" label="PR Booked"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_pr }}" label="PR Approved"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_po_booked }}" label="PO Booked"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_po }}" label="PO Issued"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_grs }}" label="GRS Amount"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_payment }}" label="Payment Amount"/>
					<x-tenant.show.my-created-at value="{{ $dbu->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $dbu->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

