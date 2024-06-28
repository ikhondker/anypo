@extends('layouts.landlord.app')
@section('title','View Invoice')
@section('breadcrumb','View Invoice')

@section('content')


@if (auth()->user()->isSystem())
	<a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-danger float-end mt-n1"><i class="fas fa-edit"></i> Edit(*)</a>
@endif
<h1 class="h3 mb-3">Invoice #{{ $invoice->invoice_no }}</h1>

@include('landlord.includes.invoice')

@endsection
