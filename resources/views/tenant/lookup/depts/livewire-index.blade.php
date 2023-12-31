@extends('layouts.app')
@section('title','Dept')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Departments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Dept"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			@livewire('index.dept-index')

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 {{-- @include('tenant.includes.modal-boolean-advance')     --}}

@endsection

