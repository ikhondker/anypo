@extends('layouts.app')
@section('title','Edit Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}">{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('pos.update',$po->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Basic Information PO #{{ $po->id }}</h5>
							<h6 class="card-subtitle text-muted">Edit Basic Information of Purchase Order.</h6>

						</div>
						<div class="card-body">

							{{-- <div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $po->id ) }}" readonly>
							</div> --}}

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">PO Summary</label>
								<div class="col-sm-10">
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="PR summary"
									value="{{ old('summary', $po->summary ) }}"
									required/>
								@error('summary')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">PO Date</label>
								<div class="col-sm-10">
									<input type="text" class="form-control"
									name="dsp_date" id="dsp_date" value="{{ date_format($po->po_date,"d-M-Y H:i:s");  }}"
									readonly/>
								</div>
							</div>

							@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
								<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
							@else
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Dept Name</label>
									<div class="col-sm-10">
										<select class="form-control select2" data-toggle="select2" name="dept_id" id="dept_id">
											@foreach ($depts as $dept)
												<option {{ $dept->id == old('dept_id',$po->dept_id) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }} </option>
											@endforeach
										</select>
										@error('dept_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif


							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">Supplier</label>
								<div class="col-sm-10">
									<select class="form-control select2" data-toggle="select2" name="supplier_id" id="supplier_id">
										@foreach ($suppliers as $supplier)
											<option {{ $supplier->id == old('supplier_id',$po->supplier_id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }} </option>
										@endforeach
									</select>
									@error('supplier_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">Project</label>
								<div class="col-sm-10">
									<select class="form-control select2" data-toggle="select2" name="project_id" id="project_id">
										@foreach ($projects as $project)
											<option {{ $project->id == old('project_id',$po->project_id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }} </option>
										@endforeach
									</select>
									@error('project_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
							

							

							<x-tenant.edit.currency :value="$po->currency"/>

							{{-- <x-tenant.buttons.show.save/> --}}

						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Purchase Order Other Information</h5>
							<h6 class="card-subtitle text-muted">Edit Purchase Order Other Information.</h6>
						</div>
						<div class="card-body">
						
							<x-tenant.edit.notes :value="$po->notes"/>
							
							<x-tenant.attachment.create />

							<div class="mb-3">
								<label class="form-label">Requestor</label>
								<select class="form-control" name="requestor_id">
									@foreach ($users as $user)
										<option {{ $user->id == old('requestor_id',$po->requestor_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
									@endforeach
								</select>
								@error('requestor_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						
								
							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			<!-- widget-po-lines -->
			<x-tenant.widgets.pol.show-po-lines id="{{ $po->id }}">
				@include('tenant.includes.po.po-footer-show')
			</x-tenant.widgets.pol.show-po-lines>

					
			<!-- widget-po-lines -->
			{{-- <x-tenant.widgets.po.lines id="{{ $po->id }}" :show="true"/> --}}

	</form>
	<!-- /.form end -->
@endsection

