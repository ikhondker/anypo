@extends('layouts.landlord')
@section('title','Test Page')
@section('breadcrumb','Templates v1.2 (31-JAN-23)')

@section('content')

	<div class="card">
		<div class="card-body">

			<div class="col-auto ms-auto text-end mt-n1">
				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="calendar"></i> Today
					</a>
			
					<div class="dropdown-menu dropdown-menu-end">
						<h6 class="dropdown-header">Settings</h6>
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Separated link</a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection