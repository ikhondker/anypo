@extends('layouts.app')
@section('title','View Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></li>
	<li class="breadcrumb-item active">{{ $item->code }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Item"/>
			<x-tenant.buttons.header.create object="Item"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Item Detail</h5>
					<h6 class="card-subtitle text-muted"><h6 class="card-subtitle text-muted">Detail Information of an Item.</h6>.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $item->name }}"/>
					<x-tenant.show.my-text		value="{{ $item->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $item->glType->name }}" label="Gl Type"/>
					<x-tenant.show.my-text		value="{{ $item->category->name }}" label="Category"/>
					<x-tenant.show.my-text		value="{{ $item->oem->name }}" label="OEM"/>
					<x-tenant.show.my-text		value="{{ $item->uom_class->name }}" label="UoM Class"/>	
					<x-tenant.show.my-text		value="{{ $item->uom->name }}" label="UoM"/>
					<x-tenant.show.my-number	value="{{ $item->price }}" label="Price"/>
					<x-tenant.show.my-text		value="{{ $item->ac_expense }}" label="Expense Account"/>

					<x-tenant.show.my-boolean	value="{{ $item->enable }}"/>
					<x-tenant.show.my-created_at value="{{ $item->created_at }}"/>
					<x-tenant.show.my-updated_at value="{{ $item->updated_at }}"/>
					
					<x-tenant.buttons.show.edit object="Item" :id="$item->id"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

