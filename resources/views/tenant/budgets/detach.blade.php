@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Remove Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.create object="Budget"/>
			<x-tenant.buttons.header.edit object="Budget" :id="$budget->id"/>
			<a href="{{ route('projects.show', $budget->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
		@endslot
	</x-tenant.page-header>
	
	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge    value="{{ $budget->id }}"/>
					<x-tenant.show.my-text     value="{{ $budget->name }}"/>
					<x-tenant.show.my-date     value="{{ $budget->start_date  }}"/>
					<x-tenant.show.my-date     value="{{ $budget->end_date  }}"/>
					<x-tenant.show.my-text     value="{{ $budget->name }}" label="Name"/>
					<x-tenant.show.my-text     value="{{ $budget->notes }}" label="Notes"/>
					<x-tenant.show.my-boolean  value="{{ $budget->freeze }}"  label="Freeze?"/>
				</div>
			</div>

			

		</div>
	</div>
	<!-- end row -->
   
	@include('tenant.includes.detach-by-article')
 

@endsection

