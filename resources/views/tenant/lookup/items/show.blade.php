@extends('layouts.app')
@section('title','View Item')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Item"/>
			<x-tenant.buttons.header.create object="Item"/>
			<x-tenant.buttons.header.edit object="Item" :id="$item->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Item Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $item->name }}"/>
					<x-tenant.show.my-text		value="{{ $item->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $item->relGlType->name }}" label="Gl Type"/>
					<x-tenant.show.my-text		value="{{ $item->category->name }}" label="Category"/>
					<x-tenant.show.my-text		value="{{ $item->oem->name }}" label="OEM"/>
					<x-tenant.show.my-text		value="{{ $item->uom->name }}" label="UoM"/>
					<x-tenant.show.my-number	value="{{ $item->price }}" label="Price"/>
					<x-tenant.show.my-badge		value="{{ $item->id }}" label="ID"/>
					<x-tenant.show.my-boolean	value="{{ $item->enable }}"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date-time value="{{$item->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$item->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

