@extends('layouts.tenant.app')
@section('title','Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('item-categories.index') }}" class="text-muted">Item Categories</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Item Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="ItemCategory"/>
		@endslot
	</x-tenant.page-header>


	<!-- form start -->
	<form id="myform" action="{{ route('item-categories.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					{{-- <a href="{{ route('item-categories.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a> --}}
				</div>
				<h5 class="card-title">Category Info</h5>
				<h6 class="card-subtitle text-muted">Create new Category</h6>
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
