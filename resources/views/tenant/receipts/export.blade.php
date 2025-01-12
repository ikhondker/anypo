@extends('layouts.tenant.app')
@section('title','Export Receipts')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}" class="text-muted">Receipts</a></li>
	<li class="breadcrumb-item active">Export</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Export Parameter
		@endslot
		@slot('buttons')
			{{-- <a href="{{ route('exports.index') }}" class="btn btn-primary float-end me-2"><i data-lucide="list"></i> Exports List</a> --}}
		@endslot
	</x-tenant.page-header>

	<x-tenant.export-param entity="{{ EntityEnum::RECEIPT->value }}"/>

@endsection
