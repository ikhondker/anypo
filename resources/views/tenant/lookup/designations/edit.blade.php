@extends('layouts.tenant.app')
@section('title','Edit Designation')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('designations.index') }}" class="text-muted">Designations</a></li>
	<li class="breadcrumb-item">{{ $designation->name }}</li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Designation
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.designation-actions designationId="{{ $designation->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('designations.update',$designation->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('designations.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
				</div>
				<h5 class="card-title">Edit Designation</h5>
				<h6 class="card-subtitle text-muted">Edit a designations</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name :value="$designation->name"/>
							<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->
	<x-tenant.widgets.back-to-list model="Designation"/>
@endsection

