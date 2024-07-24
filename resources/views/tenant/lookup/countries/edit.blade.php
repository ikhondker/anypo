@extends('layouts.tenant.app')
@section('title','Edit Country')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('countries.index') }}" class="text-muted">Countries</a></li>
	<li class="breadcrumb-item active">{{ $country->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Country
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.country-actions code="{{ $country->country }}"/>

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('countries.update',$country->country) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('countries.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i>Create</a>
					<a href="{{ route('countries.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Country Edit</h5>
				<h6 class="card-subtitle text-muted">Edit a Country.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Code:</th>
							<td>
								<input type="text" name="country" id="country" class="form-control"
								placeholder="ID" value="{{ old('country', $country->country ) }}"
								readonly/>
							</td>
						</tr>
						<x-tenant.edit.name value="{{ $country->name }}"/>

						<x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->
@endsection

