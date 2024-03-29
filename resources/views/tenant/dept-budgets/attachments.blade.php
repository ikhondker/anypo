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
			<x-tenant.actions.dept-budget-actions id="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.dept-budget-info :id="$deptBudget->id"/>

	
	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::DEPTBUDGET->value }}" aid="{{ $deptBudget->id }}"/>

	@include('tenant.includes.js.sweet-alert2-advance')

@endsection

