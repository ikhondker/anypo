@extends('layouts.tenant.app')
@section('title','Currency')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('currencies.index') }}" class="text-muted">Currencies</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Currency
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('currencies.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('currencies.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create Currency</h5>
				<h6 class="card-subtitle text-muted">Create new currency.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Currency Code</th>
							<td>
								<input type="text" class="form-control @error('currency') is-invalid @enderror"
								name="currency" id="currency" placeholder="XXX"
								style="text-transform: uppercase"
								value="{{ old('currency', '' ) }}"
								required/>
							@error('currency')
								<div class="text-danger text-xs">{{ $message }}</div>
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
