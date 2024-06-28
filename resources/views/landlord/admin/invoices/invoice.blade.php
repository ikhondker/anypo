@extends('layouts.landlord.blank')
@section('title', 'View Invoice')
@section('breadcrumb', 'View Invoice')


@section('content')

	{{-- <h1 class="h3 mb-3">Invoice</h1> --}}

	@include('landlord.includes.invoice')

@endsection
