@extends('layouts.app')
@section('title','Initial Onetime Setup')
@section('breadcrumb','Initial Setup')

@section('freeze')

	<x-tenant.page-header>
		@slot('title')
			Initial Onetime Setup
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.freeze',$setup->id) }}" method="POST">
		@csrf
		

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Currency Setup </h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								
								<div class="alert alert-danger alert-outline" role="alert">
									<div class="alert-icon">
										<i class="far fa-fw fa-bell"></i>
									</div>
									<div class="alert-message text-danger">
										<strong class="text-danger">WARNING!</strong> Please note you wont be able to change this currency setting once you have saved!
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label">Currency</label>
								<select class="form-control" name="currency">
									@foreach ($currencies as $currency)
										<option {{ $currency->currency == old('currency',$setup->currency) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->name }} </option>
									@endforeach
								</select>
							</div>
						
							<x-tenant.widgets.submit/>
						</div>
					</div>
					
				</div>
				<div class="col-6">
				</div>
			</div>

			<!-- end row -->
	</form>
	<!-- /.form end -->
@endsection

