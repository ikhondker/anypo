@extends('layouts.tenant.app')
@section('title','Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}" class="text-muted">Department</a></li>
	<li class="breadcrumb-item active">Create Dept</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Dept
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Dept"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('depts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create Department</h5>
				<h6 class="card-subtitle text-muted">Create new department with Requisition and Purchase Order Approval Hierarchy.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.name/>
						<tr>
							<th>PR Hierarchy :</th>
							<td>
								<select class="form-control" name="pr_hierarchy_id" required>
									<option value=""><< Hierarchy >> </option>
									@foreach ($hierarchies as $hierarchy)
										<option value="{{ $hierarchy->id }}" {{ $hierarchy->id == old('pr_hierarchy_id') ? 'selected' : '' }} >{{ $hierarchy->name }}</option>
									@endforeach
								</select>
								@error('pr_hierarchy_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>PO Hierarchy :</th>
							<td>
								<select class="form-control" name="po_hierarchy_id" required>
									<option value=""><< Hierarchy >> </option>
									@foreach ($hierarchies as $hierarchy)
										<option value="{{ $hierarchy->id }}" {{ $hierarchy->id == old('pr_hierarchy_id') ? 'selected' : '' }} >{{ $hierarchy->name }}</option>
									@endforeach
								</select>
								@error('po_hierarchy_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-tenant.create.save/>

					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection
