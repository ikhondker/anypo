@extends('layouts.tenant.app')
@section('title','DeptBudget')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}">Dept Budgets</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create DeptBudget
		@endslot
		@slot('buttons')
		<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="DeptBudget"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dept-budgets.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create Departmental Budget</h5>
						<h6 class="card-subtitle text-muted">Create Departmental Budget.</h6>
					</div>
					<div class="card-body">
						
						<div class="mb-3">
							<label class="form-label">Budget Year/Name</label>
							<select class="form-control" name="budget_id" required>
								<option value=""><< Budget >> </option>
								@foreach ($budgets as $budget)
									<option value="{{ $budget->id }}" {{ $budget->id == old('budget_id') ? 'selected' : '' }} >{{ $budget->name }} </option>
								@endforeach
							</select>
							@error('budget_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Dept</label>
							<select class="form-control" name="dept_id" required>
								<option value=""><< Dept >> </option>
								@foreach ($depts as $dept)
									<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }} </option>
								@endforeach
							</select>
							@error('dept_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<x-tenant.create.amount/>
						<x-tenant.create.notes/>

						<x-tenant.buttons.show.save/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection