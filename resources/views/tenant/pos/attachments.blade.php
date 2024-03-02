@extends('layouts.app')
@section('title',' Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.po-info id="{{ $po->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PO->value }}" aid="{{ $po->id }}"/>
		
	@include('tenant.includes.modal-boolean-advance')
	
@endsection

