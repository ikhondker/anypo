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
			<x-tenant.buttons.header.lists model="DeptBudget"/>
			<x-tenant.buttons.header.create model="DeptBudget"/>
			<x-tenant.actions.dept-budget-actions deptBudgetId="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.dept-budget-info deptBudgetId="{{ $deptBudget->id }}"/> --}}


	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::DEPTBUDGET->value }}" articleId="{{ $deptBudget->id }}"/>


	<div class="row">
		<div class="col-sm-6">
				<x-tenant.attachment.add entity="{{ EntityEnum::DEPTBUDGET->value }}" articleId="{{ $deptBudget->id }}"/>
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('dept-budgets.show', $deptBudget->id) }}"><i data-lucide="arrow-left-circle"></i> Back to Budgets</a>
		</div>
	</div>


@endsection

