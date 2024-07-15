@extends('layouts.tenant.app')
@section('title','Edit Group')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Groups</a></li>
	<li class="breadcrumb-item"><a href="{{ route('groups.show',$group->id) }}">{{ $group->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Group
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Group"/>
			<x-tenant.buttons.header.create object="Group"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('groups.update',$group->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('oems.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				<h5 class="card-title">Edit Item Group</h5>
				<h6 class="card-subtitle text-muted">Edit an Item Group</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name :value="$group->name"/>
						<x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->
@endsection

