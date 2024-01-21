@extends('layouts.app')
@section('title','Wf')
@section('breadcrumb','Create Wf')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Wf
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Wf"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('wfs.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Wf Info</h5>
					</div>
					<div class="card-body">


						<div class="mb-3">
							<label class="form-label">Wf Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Wf Name"
								value="{{ old('name', '' ) }}"
								required/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.widgets.submit/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection