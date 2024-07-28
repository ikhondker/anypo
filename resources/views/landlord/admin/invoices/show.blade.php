@extends('layouts.landlord.app')
@section('title','View Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item active">{{ $invoice->invoice_no }}</li>
@endsection

@section('content')


@if (auth()->user()->isSystem())
	<a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-danger float-end mt-n1"><i class="fas fa-edit"></i> Edit(*)</a>
@endif
<h1 class="h3 mb-3">Invoice #{{ $invoice->invoice_no }}</h1>

@include('landlord.includes.invoice')

@endsection
