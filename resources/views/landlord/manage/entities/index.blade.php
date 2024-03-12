@extends('layouts.landlord-app')
@section('title', 'Entities')
@section('breadcrumb', 'Entities')

@section('content')


	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">Entity Lists</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Model</th>
						<th>Directory/Route</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($entities as $entity)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
										src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $entity->entity }}</h6>
										</a>
										<small class="d-block">{{ $entity->name }}</small>
									</div>
								</div>
							</td>
							<td>{{ $entity->model }}</td>
							<td>{{ $entity->directory }} <small class="d-block">{{ $entity->route }}</small></td>
							<td><x-landlord.list.my-enable :value="$entity->enable" /></td>
							<td><x-landlord.list.actions object="Entity" :id="$entity->entity" :edit="true"
									:enable="true" /></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->

	</div>
	<!-- End Card -->


@endsection
