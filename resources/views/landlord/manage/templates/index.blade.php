@extends('layouts.landlord-app')
@section('title','Templates')
@section('breadcrumb','Templates v1.3 (6-MAR-23)')

@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Templates List</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('templates.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create Template
			</a>
		</div>



			<!-- Table -->
			<div class="table-responsive">
				<table class="table table-sm table-borderless table-thead-bordered card-table">
					<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Phone</th>
						<th scope="col">Date</th>
						<th scope="col" class="text-end">Amount</th>
						<th scope="col">Name2</th>
						<th scope="col">Role</th>
						<th scope="col" class="text-center">Enable</th>
						<th scope="col">Action</th>
					</tr>
					</thead>
					<tbody>
						@foreach ($templates as $template)
						<tr>
							<td class="">{{ $loop->iteration  }}</td>
							<td class=""><a class="text-info" href="{{ route('templates.show',$template->id) }}">{{ $template->name }}</a></td>
							<td class="">{{ $template->phone }}</td>
							<td>{{ strtoupper(date('d-M-y', strtotime($template->my_date))) }}</td>
							<td class="text-end">{{number_format($template->amount, 2)}} </td>
							<td class="">{{  $template->user->name}}</td>
							<td class=""><span class="badge bg-primary">{{  $template->my_enum}}</span> </td>
							<td class="text-center">
								<span class="badge {{ ($template->enable ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger') }}">{{ ($template->enable ? 'Yes' : 'No') }}</span>
							</td>
							<td class="table-action">
								<x-landlord.list.actions object="Template" :id="$template->id"/>
								<a href="{{ route('templates.destroy',$template->id) }}" class="me-2 sw2-advance"
									data-entity="Template" data-name="{{ $template->name }}" data-status="{{ ($template->enable ? 'Disable' : 'Enable') }}"
									data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($template->enable ? 'Disable' : 'Enable') }}">
									<i class="align-middle text-muted" data-feather="{{ ($template->enable ? 'bell-off' : 'bell') }}"></i>
								</a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
			<!-- End Table -->

			 <!-- card-body -->
		<div class="card-body">
			{{ $templates->links() }}
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

	@include('shared.includes.js.sw2-advance')
@endsection

