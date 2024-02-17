@extends('layouts.app')
@section('title','Purchase Order Receipts')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Receipt for POL #{{ $pol->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pol"/>
			<x-tenant.buttons.header.create object="Pol"/>
			{{-- <a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a> --}}
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.pol-info id="{{ $pol->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />


@endsection

