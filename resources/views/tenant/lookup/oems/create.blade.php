@extends('layouts.tenant.app')
@section('title','Oem')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('oems.index') }}" class="text-muted">OEMs</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create OEM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Oem"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('oems.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">

				</div>
				<h5 class="card-title">Create OEM</h5>
				<h6 class="card-subtitle text-muted">Create a new OEM</h6>
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
