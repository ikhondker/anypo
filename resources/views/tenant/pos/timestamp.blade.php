@extends('layouts.tenant.app')
@section('title','View Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item active">PO#{{ $po->id }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Order #{{ $po->id }}
		@endslot
		@slot('buttons')
			<a href="{{ route('pos.index') }}" class="btn btn-primary float-end me-2"><i data-lucide="list"></i> View All</a>
			@can('create', $po)
				<x-tenant.buttons.header.create model="Po" label="Purchase Order"/>
			@endcan

			<x-tenant.actions.po-actions poId="{{ $po->id }}"/>

		@endslot
	</x-tenant.page-header>

		<x-tenant.widgets.who-when model="Po" articleId="{{ $po->id  }}"/>

	<x-tenant.widgets.back-to-list model="Po"/>


@endsection

