@extends('layouts.landlord-app')
@section('title', 'config')
@section('breadcrumb', 'config')

@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">Your config</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Banner</th>
						<th>Maintenance</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($configs as $config)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('configs.show',$config->id) }}">
											<h6 class="text-hover-primary mb-0">{{ $config->name }}</h6>
										</a>
										<small class="d-block">{{ $config->tagline }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$config->created_at" /></td>
							<td><x-landlord.list.my-enable :value="$config->banner" /></td>
							<td><x-landlord.list.my-enable :value="$config->maintenance" /></td>
							<td><x-landlord.list.actions object="config" :id="$config->id" :export="false" :enable="false" /></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->

	</div>
	<!-- End Card -->

@endsection
