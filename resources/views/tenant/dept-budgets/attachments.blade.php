@extends('layouts.tenant.app')
@section('title','Dept Budget Attachments')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}" class="text-muted">{{ $deptBudget->budget->fy }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item active">{{ $deptBudget->dept->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dept Budget Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
			<x-tenant.actions.dept-budget-actions deptBudgetId="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.dept-budget-info :id="$deptBudget->id"/>

	
	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::DEPTBUDGET->value }}" aid="{{ $deptBudget->id }}"/>

	

@endsection

