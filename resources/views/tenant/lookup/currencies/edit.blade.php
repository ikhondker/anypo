@extends('layouts.tenant.app')
@section('title','Edit Currency')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('currencies.index') }}">Currencies</a></li>
	<li class="breadcrumb-item"><a href="{{ route('currencies.show',$currency->currency) }}">{{ $currency->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Currency
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Currency"/>
			<x-tenant.buttons.header.create object="Currency"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('currencies.update',$currency->currency) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Currency Edit</h5>
							<h6 class="card-subtitle text-muted">Edit a currency.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Code</label> <x-tenant.info info="Note: You wont be able to change the currency."/>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('currency', $currency->currency ) }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Currency Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Currency Name"
									value="{{ old('name', $currency->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">

					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

