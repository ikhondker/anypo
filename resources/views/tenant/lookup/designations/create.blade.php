@extends('layouts.tenant.app')
@section('title','Designation')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('designations.index') }}" class="text-muted">Designations</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Designation
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Designation"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('designations.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('designations.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create Designation</h5>
						<h6 class="card-subtitle text-muted">Create a new designations</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.name/>
						<x-tenant.create.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection
