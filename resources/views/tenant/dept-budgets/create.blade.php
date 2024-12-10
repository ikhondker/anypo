@extends('layouts.tenant.app')
@section('title','DeptBudget')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create DeptBudget
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="DeptBudget"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dept-budgets.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('dept-budgets.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>
				<h5 class="card-title">Create Departmental Budget</h5>
						<h6 class="card-subtitle text-muted">Create Departmental Budget.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Budget Year/Name :</th>
							<td>
								<select class="form-control" name="budget_id" required>
									<option value=""><< Budget >> </option>
									@foreach ($budgets as $budget)
										<option value="{{ $budget->id }}" {{ $budget->id == old('budget_id') ? 'selected' : '' }} >{{ $budget->name }}</option>
									@endforeach
								</select>
								@error('budget_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>



						<tr>
							<th>Dept :</th>
							<td>
								<select class="form-control" name="dept_id" required>
									<option value=""><< Dept >> </option>
									@foreach ($depts as $dept)
										<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }}</option>
									@endforeach
								</select>
								@error('dept_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-tenant.create.amount/>
						<x-tenant.create.notes/>
						<x-tenant.create.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection
