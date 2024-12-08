@extends('layouts.tenant.app')
@section('title','Edit Oem')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('oems.index') }}" class="text-muted">OEMs</a></li>
	<li class="breadcrumb-item">{{ $oem->name }}</li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit OEM
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.oem-actions oemId="{{ $oem->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('oems.update',$oem->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('oems.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
				</div>
				<h5 class="card-title">Edit OEM</h5>
				<h6 class="card-subtitle text-muted">Edit an OEM</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name :value="$oem->name"/>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>
	</form>
	<!-- /.form end -->

    <x-tenant.widgets.back-to-list model="Oem"/>

@endsection

