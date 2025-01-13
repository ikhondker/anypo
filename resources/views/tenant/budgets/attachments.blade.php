@extends('layouts.tenant.app')
@section('title','Budget Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}" class="text-muted">Budgets</a></li>
	<li class="breadcrumb-item"><a href="{{ route('budgets.show',$budget->id) }}" class="text-muted">{{ $budget->name }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>

@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budget Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Budget"/>
			<x-tenant.buttons.header.edit model="Budget" :id="$budget->id"/>
			<x-tenant.buttons.header.create model="Budget"/>
			<x-tenant.actions.budget-actions budgetId="{{ $budget->id }}"/>

		@endslot
	</x-tenant.page-header>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::BUDGET->value }}" articleId="{{ $budget->id }}"/>

    <div class="row">
		<div class="col-sm-6">
                <x-tenant.attachment.add entity="{{ EntityEnum::BUDGET->value }}" articleId="{{ $budget->id }}"/>
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('budgets.show', $budget->id) }}"><i data-lucide="arrow-left-circle"></i> Back to Budgets</a>
		</div>
	</div>

@endsection

