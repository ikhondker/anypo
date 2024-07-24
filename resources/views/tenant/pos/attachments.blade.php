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
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.po-info id="{{ $po->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PO->value }}" aid="{{ $po->id }}"/>
		
	
	
@endsection

