@extends('layouts.tenant.app')
@section('title','Budgets')

@section('breadcrumb')
	@if (! auth()->user()->isHoD())
		<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}" class="text-muted">{{ $deptBudget->budget->fy }}</a></li>
	@endif
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item active">{{ $deptBudget->dept->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget - {{ $deptBudget->dept->name }}
		@endslot
		@slot('buttons')
			<x-tenant.actions.dept-budget-actions deptBudgetId="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.widgets.who-when model="DeptBudget" articleId="{{ $deptBudget->id }}"/>

	<x-tenant.widgets.back-to-list model="DeptBudget"/>


@endsection

