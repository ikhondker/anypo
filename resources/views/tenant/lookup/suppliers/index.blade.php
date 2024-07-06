@extends('layouts.tenant.app')
@section('title','Supplier Master')
@section('breadcrumb')
	<li class="breadcrumb-item active">Supplier Master</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
		Supplier
		@endslot
		@slot('buttons')
			@can('create', App\Models\Tenant\Lookup\Supplier::class)
			<x-tenant.buttons.header.create object="Supplier"/>
			@endcan
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
								<p class="mb-0">Supplier Listing</p>
							</div>
						</div>
						<div class="col-6 align-self-end text-end">
							{{-- <img src="{{asset('img/illustrations/customer-support.png')}}" width="100px" height="100px" alt="Social" class="img-fluid illustration-img"> --}}
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
							<h5 class="card-title">Total Suppliers</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="database"></i>
							</div>
						</div>
					</div>
					@php
						use App\Models\Tenant\Lookup\Supplier;
						$count_total	= Supplier::count();
						$count_enable	= Supplier::where('enable',true )->count();
						$count_disable	= Supplier::where('enable',false )->count();
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
							<h5 class="card-title">Active Suppliers</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="bell"></i>
							</div>
						</div>
					</div>

					<span class="h1 d-inline-block mt-1">{{ $count_enable }}</span>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Inactive Suppliers</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="bell-off"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1">{{ $count_disable }}</span>
				</div>
			</div>
		</div>

	</div>



	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Supplier"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Supplier Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Suppliers and their contact person.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Contact Person</th>
								<th>Cell</th>
								<th>Enable</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($suppliers as $supplier)
							<tr>
								<td>{{ $suppliers->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('suppliers.show',$supplier->id) }}">{{ $supplier->name }}</a></td>
								<td>{{ $supplier->contact_person }}</td>
								<td>{{ $supplier->cell }}</td>
								<td><x-tenant.list.my-boolean :value="$supplier->enable"/></td>
								<td class="table-action">
									<a href="{{ route('suppliers.show',$supplier->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
									</a>


								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $suppliers->links() }}
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

