@extends('layouts.landlord.page')
@section('title','Payment Canceled')

@section('content')

		<div class="container">

			<div class="row align-items-center">
				<div class="col-8 pt-4">

					<div class="card bg-soft-muted">
						<h5 class="card-header"><i data-feather="alert-triangle" class="fea text-danger"></i> An Error Occurred!</h5>
						<div class="card-body">
							<h5 class="card-title">Payment Canceled!</h5>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<p class="card-text">Please contact support at support@HawarIT.com</p>
							<a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
						</div>
					</div>

				</div><!--end col-->
			</div><!--end row-->

		</div><!--end container-->

@endsection