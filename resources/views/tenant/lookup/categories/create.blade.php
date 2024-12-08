@extends('layouts.tenant.app')
@section('title','PR/PO Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">PR/PO Categories</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create PR/PO Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Category"/>
		@endslot
	</x-tenant.page-header>


	<!-- form start -->
	<form id="myform" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">

				</div>
				<h5 class="card-title">PR/PO Category Info</h5>
				<h6 class="card-subtitle text-muted">Create new PR/PO Category</h6>
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
