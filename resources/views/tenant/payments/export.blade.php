@extends('layouts.tenant.app')
@section('title','Export Payments')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('payments.index') }}" class="text-muted">Payments</a></li>
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

	<x-tenant.export-param entity="{{ EntityEnum::PAYMENT->value }}"/>

@endsection
