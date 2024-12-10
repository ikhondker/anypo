@extends('layouts.tenant.app')
@section('title','Country')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('countries.index') }}" class="text-muted">Countries</a></li>
	<li class="breadcrumb-item active">Create Country</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Country
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists model="Country"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('countries.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>
				<h5 class="card-title">Create Country</h5>
				<h6 class="card-subtitle text-muted">Create new Country.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Country Code</th>
							<td>
								<input type="text" class="form-control @error('country') is-invalid @enderror"
								name="country" id="country" placeholder="XX"
								maxlength="2"
								style="text-transform: uppercase"
								value="{{ old('country', '' ) }}"
								required/>
							@error('country')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<x-tenant.create.name/>

						<x-tenant.create.save/>

					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection
