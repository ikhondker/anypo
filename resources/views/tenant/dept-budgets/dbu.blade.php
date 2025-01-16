@extends('layouts.tenant.app')
@section('title','Dept Budget Usages')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dept Budget Usages
		@endslot
		@slot('buttons')
			<x-tenant.actions.dept-budget-actions deptBudgetId="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.info.dept-budget-info deptBudgetId={{ $deptBudget->id }}/>

	<x-tenant.widgets.dbu-dept-budget deptBudgetId={{ $deptBudget->id }}/>


@endsection

