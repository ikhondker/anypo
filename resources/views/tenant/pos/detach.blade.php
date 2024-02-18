@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Remove Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
			<x-tenant.buttons.header.create object="Po"/>
			<x-tenant.buttons.header.edit object="Po" :id="$po->id"/>
			<a href="{{ route('pos.show', $po->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View PO</a>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.po-info id="{{ $po->id }}"/>

	@include('tenant.includes.detach-by-article')
 
@endsection

