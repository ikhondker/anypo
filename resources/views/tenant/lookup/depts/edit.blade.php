@extends('layouts.tenant.app')
@section('title','Edit Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}" class="text-muted">Departments</a></li>
	<li class="breadcrumb-item active">{{ $dept->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Dept
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.dept-actions deptId="{{ $dept->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('depts.update',$dept->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('depts.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
				</div>
				<h5 class="card-title">Edit Dept</h5>
				<h6 class="card-subtitle text-muted">Edit department and Requisition and Purchase Order Approval Hierarchy.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name :value="$dept->name"/>
						<tr>
							<th>PR Hierarchy :</th>
							<td>
								<select class="form-control" name="pr_hierarchy_id">
									@foreach ($hierarchies as $hierarchy)
										<option {{ $hierarchy->id == old('pr_hierarchy_id',$dept->pr_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }}</option>
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
								<select class="form-control" name="po_hierarchy_id">
									@foreach ($hierarchies as $hierarchy)
										<option {{ $hierarchy->id == old('po_hierarchy_id',$dept->po_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }}</option>
									@endforeach
								</select>
								@error('po_hierarchy_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->
    <x-tenant.widgets.back-to-list model="Dept"/>

@endsection

