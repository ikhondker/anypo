@extends('layouts.app')
@section('title','Edit Budget')
@section('breadcrumb','Edit Budget')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Budget
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.create object="Budget"/>
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
							<h5 class="card-title">Budget Info</h5>
							<h6 class="card-subtitle text-muted">Note: To edit budget amount, edit the Department budget. It will be automatically reflected in company budget.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">FY</label>
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
							<div class="card-actions float-end">
								<div class="dropdown position-relative">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-horizontal"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="{{ route('budgets.detach',$budget->id) }}">Delete Attachment</a>
									</div>
								</div>
							</div>
							<h5 class="card-title">Attachments</h5>
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

