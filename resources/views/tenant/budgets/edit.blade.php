@extends('layouts.tenant.app')
@section('title','Edit Budget')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}">Budgets</a></li>
	<li class="breadcrumb-item"><a href="{{ route('budgets.show',$budget->id) }}">{{ $budget->name }}</a></li>
	<li class="breadcrumb-item active"> Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Budget
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.create object="Budget"/>
			<x-tenant.actions.budget-actions id="{{ $budget->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('budgets.update',$budget->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Budget Detail</h5>
							<h6 class="card-subtitle text-muted">Note: To edit budget amount, edit the Department budget. It will be automatically reflected in company budget.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">FY</label> <x-tenant.info info="Note: You wont be able to change the Fiscal Year (FY)."/>
								<input type="text" name="fy" id="fy" class="form-control" placeholder="ID" value="{{ $budget->fy }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Budget Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Budget Name"
									value="{{ old('name', $budget->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.edit.notes value="{{ $budget->notes }}"/>

							<x-tenant.attachment.create/>

							<x-tenant.buttons.show.save/>

						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Attachments</h5>
							<h6 class="card-subtitle text-muted">Budget Attachments.</h6>
						</div>
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3 text-end">
									<span class="h6 text-secondary">Attachments:</span>
								</div>
								<div class="col-sm-9">
									<x-tenant.attachment.all entity="BUDGET" aid="{{ $budget->id }}"/>
								</div>
							</div>

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

