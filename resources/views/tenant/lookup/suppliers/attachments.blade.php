@extends('layouts.tenant.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}" class="text-muted">Suppliers</a></li>
	<li class="breadcrumb-item"><a href="{{ route('suppliers.show',$supplier->id) }}" class="text-muted">{{ $supplier->name }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Supplier : {{ $supplier->name }} : Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Supplier" label="Supplier"/>
			<x-tenant.actions.lookup.supplier-actions supplierId="{{ $supplier->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.pr-info prId="{{ $pr->id }}"/> --}}

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::SUPPLIER->value }}" articleId="{{ $supplier->id }}"/>

	<div class="row">
		<div class="col-sm-6">
            <x-tenant.attachment.add entity="{{ EntityEnum::SUPPLIER->value }}" articleId="{{ $supplier->id }}"/>
		</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('suppliers.show', $supplier->id) }}"><i data-lucide="arrow-left-circle"></i> Back to Suppliers</a>
		</div>
	</div>
@endsection

