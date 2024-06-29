@extends('layouts.tenant.app')
@section('title','Edit DeptBudget')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}">{{ $deptBudget->budget->fy }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}">Dept Budgets</a></li>
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.show',$deptBudget->id) }}">{{ $deptBudget->dept->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Department Budget - {{ $deptBudget->dept->name }} - {{ $deptBudget->budget->fy }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
			<x-tenant.actions.dept-budget-actions id="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dept-budgets.update',$deptBudget->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Departmental Budget</h5>
							<h6 class="card-subtitle text-muted">Edit Departmental Budget.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">FY</label> <x-tenant.info info="Note: You wont be able to change the Fiscal Year (FY)."/>
								<input type="text" name="budget_fy" id="budget_fy" class="form-control" placeholder="" value="{{ $deptBudget->budget->fy }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Budget</label>
								<input type="text" name="budget_name" id="budget_name" class="form-control" placeholder="" value="{{ $deptBudget->budget->name }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Dept</label>
								<input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="" value="{{ $deptBudget->dept->name }}" readonly>
							</div>

							<x-tenant.edit.amount :value="$deptBudget->amount"/>
							<x-tenant.edit.notes value="{{ $deptBudget->notes }}"/>

						
							<x-tenant.buttons.show.save/>
							
						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">
						
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			
	</form>
	<!-- /.form end -->

	
@endsection

