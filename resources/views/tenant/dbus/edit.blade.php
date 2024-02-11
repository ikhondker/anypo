@extends('layouts.app')
@section('title','Edit DeptBudget')
@section('breadcrumb','Edit DeptBudget')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit DeptBudget
		@endslot
		@slot('buttons')
		<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dept-budgets.update',$deptBudget->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">DeptBudget Info</h5>
						</div>
						<div class="card-body">

							<x-tenant.edit.id-read-only :value="$deptBudget->id"/>

							<div class="mb-3">
								<label class="form-label">FY</label>
								<input type="text" name="budget_fy" id="budget_fy" class="form-control" placeholder="" value="{{ $deptBudget->budget->fy }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Budget</label>
								<input type="text" name="budget_name" id="budget_name" class="form-control" placeholder="" value="{{ $deptBudget->budget->name  }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Dept</label>
								<input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="" value="{{ $deptBudget->dept->name }}" readonly>
							</div>

							<x-tenant.edit.amount :value="$deptBudget->amount"/>
							<x-tenant.edit.notes value="{{ $deptBudget->notes }}"/>

							<x-tenant.attachment.create/>
							
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

