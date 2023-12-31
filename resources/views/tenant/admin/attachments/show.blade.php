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
			<x-tenant.buttons.header.edit object="Dept" :id="$dept->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Dept Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text     value="{{ $dept->name }}"/>
					<x-tenant.show.my-badge    value="{{ $dept->id }}" label="ID"/>
					<x-tenant.show.my-boolean  value="{{ $dept->enable }}"/>
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
					<x-tenant.show.my-date-time value="{{$dept->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$dept->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

