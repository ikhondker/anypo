@extends('layouts.tenant.app')
@section('title','View Export')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('exports.index') }}" class="text-muted">Exports</a></li>
	<li class="breadcrumb-item active">{{ $export->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Export
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Export"/>
			{{-- <x-tenant.buttons.header.create model="Export"/> --}}
			{{-- <x-tenant.buttons.header.edit model="Export" :id="$export->id"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@if ( auth()->user()->isSystem() )
					<a class="btn btn-sm btn-danger text-white" href="{{ route('exports.edit', $export->entity ) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
					<a class="btn btn-sm btn-light" href="{{ route('exports.'.Str::lower($export->entity).'') }}"><i data-lucide="download-cloud"></i> Export</a>

			</div>
			<h5 class="card-title">Exports Detail</h5>
			<h6 class="card-subtitle text-muted">Details of a Export.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-badge		value="{{ $export->id }}" label="ID"/>
					<x-tenant.show.my-text		value="{{ $export->name }}"/>
					<x-tenant.show.my-text		value="{{ $export->summary }}" label="Summary"/>
					<x-tenant.show.my-badge		value="{{ $export->access }}" label="Access"/>
					<x-tenant.show.my-boolean	value="{{ $export->article_id }}" label="Article ID"/>
					<x-tenant.show.my-boolean	value="{{ $export->start_date }}" label="Start Date"/>
					<x-tenant.show.my-boolean	value="{{ $export->end_date }}" label="End Date"/>
					<x-tenant.show.my-boolean	value="{{ $export->user_id }}" label="User"/>
					<x-tenant.show.my-boolean	value="{{ $export->item_id }}" label="Item"/>
					<x-tenant.show.my-boolean	value="{{ $export->supplier_id }}" label="Supplier"/>
					<x-tenant.show.my-boolean	value="{{ $export->project_id }}" label="Project"/>
					<x-tenant.show.my-boolean	value="{{ $export->category_id }}" label="Category"/>
					<x-tenant.show.my-boolean	value="{{ $export->dept_id }}" label="Dept"/>
					<x-tenant.show.my-boolean	value="{{ $export->warehouse_id }}" label="Warehouse"/>
					<x-tenant.show.my-boolean	value="{{ $export->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $export->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $export->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

