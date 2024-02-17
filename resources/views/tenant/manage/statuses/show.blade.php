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
			<x-tenant.buttons.header.edit object="Dept" :id="$status->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Dept Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $status->name }}"/>
					<x-tenant.show.my-badge		value="{{ $status->id }}" label="ID"/>
					<x-tenant.show.my-boolean	value="{{ $status->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $status->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $status->created_at }}"/>
		
				</div>
			</div>
		</div>

		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

