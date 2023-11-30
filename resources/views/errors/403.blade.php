@extends('layouts.landlord-blank')
@section('title', 'Error 403 - Page Forbidden')
@section('breadcrumb', 'Error 403 - Page Forbidden')


@section('content')

	<div class="container content-space-2">
		<div class="w-lg-85 mx-lg-auto">

			<!-- Card -->
			<div class="card card-lg mb-5">
				<div class="card-body">
					
					<div class="row justify-content-lg-between">
						<div class="col-sm order-2 order-sm-1 mb-3">
							<div class="mb-2">
								<img class="avatar" src="{{ asset('/assets/logo/logo.svg') }}" alt="Logo">
							</div>
						</div>
						<!-- End Col -->

						<div class="col-sm-auto order-1 order-sm-2 text-sm-end mb-3">
							<div class="mb-3">
								<h2 class="text-danger">Access Denied!</h2>
							</div>
							{{-- <div class="mb-3">
								<h2>Access Denied!</h2>
							</div>
 --}}
							
						</div>
						<!-- End Col -->
					</div>
					<!-- End Row -->

					<div class="row justify-content-md-between mb-3">
					   
						<!-- Content -->
						<div class="container text-center">
							<div class="mb-3">
								<img class="img-fluid" src="{{ asset('/assets/svg/illustrations/oc-error.svg') }}" alt="Image Description" style="width: 30rem;">
							</div>

							<div class="mb-4">
								<p class="fs-4 mb-0">Oops! We are sorry, but this action is not allowed by current user.</p>
								<p class="fs-4">If you think this is a problem with us, please <a class="link" href="{{ route('contact-us') }}">tell us</a>.</p>
							</div>

							<a class="btn btn-primary" href="{{ route('home') }}">Go back home</a>
						</div>

					</div>
					<!-- End Row -->

					<hr class="my-5">

					<p class="small mb-0">&copy; {{ date('Y').' '. env('APP_NAME') }}</p>
				</div>
			</div>
			<!-- End Card -->
		   
		</div>
	</div>

@endsection
