@extends('layouts.tenant.app')
@section('title','Project Spends')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item active">Project Spends</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Project Spends
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Project"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card illustration flex-fill">
				<div class="card-body p-0 d-flex flex-fill">
					<div class="row g-0 w-100">
						<div class="col-6">
							<div class="illustration-text p-3 m-1">
								<h4 class="illustration-text">Welcome Back, {{ auth()->user()->name }}!</h4>
								<p class="mb-0">Projects Listing</p>
							</div>
						</div>
						<div class="col-6 align-self-end text-end">
							<img src="{{ Storage::disk('s3t')->url('img/illustrations/customer-support.png') }}" width="100px" height="100px" alt="Social" class="img-fluid illustration-img">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Total Projects</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="activity"></i>
							</div>
						</div>
					</div>
					@php
						use App\Models\Tenant\Lookup\Project;
						$count_total	= Project::count();
						$count_open		= Project::where('closed',false )->count();
						$count_closed	= Project::where('closed',true )->count();
						//$count_draft	= Pr::where('auth_status',AuthStatusEnum::DRAFT->value )->count();
					@endphp
					<span class="h1 d-inline-block mt-1">{{ $count_total }}</span>

				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Open Projects</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="shopping-bag"></i>
							</div>
						</div>
					</div>

					<span class="h1 d-inline-block mt-1">{{ $count_open }}</span>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Closed Projects</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="shopping-cart"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1">{{ $count_closed }}</span>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<x-tenant.charts.spends-by-project-bar/>
		<x-tenant.charts.spends-by-project-count-bar/>
	</div>


	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Project"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Project Spends
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of projects and budget usages.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Code</th>
								<th class="text-end">Budget</th>
								<th class="text-end">PR</th>
								<th class="text-end">Available (PR)</th>
								<th class="text-end">PO</th>
								<th class="text-end">Available (PO)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>

								<th>Closed?</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($projects as $project)
							<tr>
								<td>{{ $projects->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('projects.po',$project->id) }}">{{ $project->code }}</a></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_pr_booked + $project->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount - $project->amount_pr_booked - $project->amount_pr "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_po_booked + $project->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount - $project->amount_po_booked - $project->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$project->closed"/></td>
								<td class="table-action">
									<a href="{{ route('projects.show',$project->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-lucide="eye"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $projects->links() }}
					</div>
					<!-- end pagination -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->



@endsection

