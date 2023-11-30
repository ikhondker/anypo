@extends('layouts.landlord-app')
@section('title', 'Categories')
@section('breadcrumb', 'Categories List')


@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Category List</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('categories.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create Category
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Category Name</th>
						
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ asset('/assets/logo/logo.png') }}" alt="Logo">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('categories.show', $category->id) }}">
											<h6 class="text-hover-primary mb-0">
												{{ $category->name }}
											</h6>
										</a>
										<small class="d-block">{{ $category->name }}</small>
									</div>
								</div>
							</td>
							
							<td><x-landlord.list.my-enable :value="$category->enable" /></td>
							<td>

								<x-landlord.list.actions object="Category" :id="$category->id" />
								<a href="{{ route('categories.destroy', $category->id) }}"
									class="text-body sweet-alert2-confirm-advance" data-entity="Category"
									data-name="{{ $category->name }}"
									data-status="{{ $category->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $category->enable ? 'Disable' : 'Enable' }}">
									<i class="bi {{ $category->enable ? 'bi-bell-slash' : 'bi-bell' }} "
										style="font-size: 1.3rem;"></i>
								</a>


								{{-- <a class="text-body" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="top" title="Locked">
									<i class="bi-lock-fill" style="font-size: 1.5rem;"></i>
									<i class="bi bi-eye" style="font-size: 1.5rem;"></i>
								</a> --}}
							</td>
						</tr>
					@endforeach


				</tbody>
			</table>
		</div>
		<!-- End Table -->

		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $categories->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

	@include('landlord.includes.sweet-alert2-confirm-advance')

@endsection
