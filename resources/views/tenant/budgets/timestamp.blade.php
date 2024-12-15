@extends('layouts.tenant.app')
@section('title','Budgets')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}" class="text-muted">Budgets</a></li>
	<li class="breadcrumb-item active">{{ $budget->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			FY {{ $budget->fy }} Budgets
		@endslot
		@slot('buttons')
			<x-tenant.actions.budget-actions budgetId="{{ $budget->id }}"/>
		@endslot
	</x-tenant.page-header>

		<x-tenant.widgets.who-when model="Budget" articleId="{{ $budget->id }}"/>

	<x-tenant.widgets.back-to-list model="Budget"/>



@endsection

