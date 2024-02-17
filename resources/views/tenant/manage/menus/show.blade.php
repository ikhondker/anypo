@extends('layouts.app')
@section('title','View Dept')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Dept
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Dept"/>
			<x-tenant.buttons.header.create object="Dept"/>
			<x-tenant.buttons.header.edit object="Dept" :id="$menu->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Menu Detail</h5>
					<h6 class="card-subtitle text-muted">Show Menu Details.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $menu->name }}"/>
					<x-tenant.show.my-badge		value="{{ $menu->id }}" label="ID"/>
					<x-tenant.show.my-boolean	value="{{ $menu->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $menu->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $menu->created_at }}"/>

								
				</div>
			</div>
		</div>
		
	</div>
	<!-- end row -->

@endsection

