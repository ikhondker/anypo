@extends('layouts.tenant.app')
@section('title','Edit DeptBudget')
@section('breadcrumb')
	@if (! auth()->user()->isHoD())
		<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}" class="text-muted">{{ $deptBudget->budget->fy }}</a></li>
	@endif
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.show',$deptBudget->id) }}" class="text-muted">{{ $deptBudget->dept->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Dept Budget
		@endslot
		@slot('buttons')
			<x-tenant.actions.dept-budget-actions id="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dept-budgets.update',$deptBudget->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('dept-budgets.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
					<a href="{{ route('dept-budgets.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Dept Budget - {{ $deptBudget->dept->name }} [{{ $deptBudget->budget->fy }}]</h5>
				<h6 class="card-subtitle text-muted">Edit Departmental Budget.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>FY <x-tenant.info info="Note: You wont be able to change the Fiscal Year (FY)."/> :</th>
							<td>
								<input type="text" name="budget_fy" id="budget_fy" class="form-control" placeholder="" value="{{ $deptBudget->budget->fy }}" readonly>
							</td>
						</tr>
						<tr>
							<th>Budget :</th>
							<td>
								<input type="text" name="budget_name" id="budget_name" class="form-control" placeholder="" value="{{ $deptBudget->budget->name }}" readonly>
							</td>
						</tr>
						<tr>
							<th>Dept :</th>
							<td>
								<input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="" value="{{ $deptBudget->dept->name }}" readonly>
							</td>
						</tr>
						<x-tenant.edit.amount :value="$deptBudget->amount"/>
						<x-tenant.edit.notes value="{{ $deptBudget->notes }}"/>
                        <x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->


@endsection

