@extends('layouts.tenant.app')
@section('title',' Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create model="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info poId="{{ $po->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PO->value }}" articleId="{{ $po->id }}"/>

	<div class="row">
		<div class="col-sm-6">
			@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
				<x-tenant.attachment.add entity="{{ EntityEnum::PO->value }}" articleId="{{ $po->id }}"/>
			@endif
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('pos.show', $po->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PO</a>
		</div>
	</div>

@endsection

