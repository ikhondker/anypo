@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Remove Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
			<x-tenant.buttons.header.edit object="DeptBudget" :id="$deptBudget->id"/>
			<a href="{{ route('dept-budgets.show', $deptBudget->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Dept Budget</a>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.dept-budget-info :id="$deptBudget->id"/>

	

	@include('tenant.includes.detach-by-article')
 

@endsection

