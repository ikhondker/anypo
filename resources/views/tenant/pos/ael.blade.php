@extends('layouts.app')
@section('title','Accounting Entries')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Accounting Lines</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Accounting Entries for PO#{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info id="{{ $po->id }}"/>

	<x-tenant.ael.ael-for-po id="{{ $po->id }}"/>

@endsection

