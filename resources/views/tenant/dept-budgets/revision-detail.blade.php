@extends('layouts.tenant.app')
@section('title','Revision Detail - Dept Budget')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}" class="text-muted">{{ $deptBudget->budget->fy }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item active">{{ $deptBudget->dept->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Revision Detail - {{ $deptBudget->dept->name }} Budget
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('dept-budgets.revisions',$deptBudget->parent_id) }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Dept Budget Revision Detail</h5>
			<h6 class="card-subtitle text-muted">Dept Budget Revision Detail detail.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<tr>
						<th>Revision ID :</th>
						<td>{{ $deptBudget->id }}</td>
					</tr>
					<tr>
						<th>FY :</th>
						<td><a href="{{ route('budgets.show',$deptBudget->budget_id) }}"><strong>{{ $deptBudget->budget->fy }}</strong></a></td>
					</tr>
					<x-tenant.show.my-text			value="{{ $deptBudget->budget->name }}"/>
					<x-tenant.show.my-number			value="{{ $deptBudget->amount }}"/>
					<x-tenant.show.my-text-area			value="{{ $deptBudget->notes }}"/>

					<tr>
						<th>Created By :</th>
						<td>{{ $deptBudget->user_created_by->name }}</td>
					</tr>
					<x-tenant.show.my-updated-at 	value="{{ $deptBudget->created_at }}"/>
					<tr>
						<th>Attachments :</th>
						<td>
							<x-tenant.attachment.all entity="DEPTBUDGET" articleId="{{ $deptBudget->id }}"/>
						</td>
					</tr>


				</tbody>
			</table>
		</div>
	</div>

@endsection

