@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Remove Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.edit object="Budget" :id="$budget->id"/>
			<x-tenant.buttons.header.create object="Budget"/>
			<x-tenant.actions.budget-actions id="{{ $budget->id }}"/>
	
		@endslot
	</x-tenant.page-header>
	
	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge		value="{{ $budget->id }}"/>
					<x-tenant.show.my-text		value="{{ $budget->name }}"/>
					<x-tenant.show.my-date		value="{{ $budget->start_date  }}"/>
					<x-tenant.show.my-date		value="{{ $budget->end_date  }}"/>
					<x-tenant.show.my-text		value="{{ $budget->name }}" label="Name"/>
					<x-tenant.show.my-closed	value="{{ $budget->closed }}"  label="Closed?"/>
					<x-tenant.show.my-text		value="{{ $budget->notes }}" label="Notes"/>
				</div>
			</div>

			

		</div>
	</div>
	<!-- end row -->

	
	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::BUDGET->value }}" aid="{{ $budget->id }}"/>

	@include('tenant.includes.js.sweet-alert2-advance')
@endsection

