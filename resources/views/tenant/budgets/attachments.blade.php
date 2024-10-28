@extends('layouts.tenant.app')
@section('title','Budget Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}" class="text-muted">Budgets</a></li>
	<li class="breadcrumb-item active">{{ $budget->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budget Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.edit object="Budget" :id="$budget->id"/>
			<x-tenant.buttons.header.create object="Budget"/>
			<x-tenant.actions.budget-actions budgetId="{{ $budget->id }}"/>

		@endslot
	</x-tenant.page-header>

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('budgets.edit', $budget->id ) }}"><i class="fas fa-edit"></i> Edit</a>
					<a class="btn btn-sm btn-light" href="{{ route('budgets.index') }}" ><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Budget Period</h5>
				<h6 class="card-subtitle text-muted">Budget Brief Information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.show.my-badge		value="{{ $budget->id }}"/>
						<x-tenant.show.my-text		value="{{ $budget->name }}"/>
						<x-tenant.show.my-date		value="{{ $budget->start_date }}"/>
						<x-tenant.show.my-date		value="{{ $budget->end_date }}"/>
                        <tr>
							<th>Budget</th>
							<td>{{number_format($budget->amount, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<x-tenant.show.my-text-area		value="{{ $budget->notes }}" label="Notes"/>
						<x-tenant.show.my-closed	value="{{ $budget->closed }}" label="Closed?"/>
					</tbody>
				</table>
			</div>
		</div>


	<x-tenant.attachment.list-all-by-article entity="{{ App\Enum\Tenant\EntityEnum::BUDGET->value }}" articleId="{{ $budget->id }}"/>


@endsection

