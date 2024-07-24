@extends('layouts.tenant.app')
@section('title','Item Group')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('groups.index') }}" class="text-muted">Groups</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Item Group
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Group"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('groups.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('groups.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create Item Group</h5>
				<h6 class="card-subtitle text-muted">Create a new Item Group</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.name/>
						<x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection