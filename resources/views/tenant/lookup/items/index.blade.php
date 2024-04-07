@extends('layouts.app')
@section('title','Item')

@section('breadcrumb')
	<li class="breadcrumb-item active">Items</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Items
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Item"/>
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
								<p class="mb-0">Items Listing</p>
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
							<h5 class="card-title">Total Items</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="activity"></i>
							</div>
						</div>
					</div>
					@php
						use App\Models\Tenant\Lookup\Item;
						$count_total	= Item::count();
						$count_enable	= Item::where('enable',true )->count();
						$count_disable	= Item::where('enable',false )->count();
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
							<h5 class="card-title">Active Items</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="shopping-bag"></i>
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
							<h5 class="card-title">Inactive Items</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="shopping-cart"></i>
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
					<x-tenant.cards.header-search-export-bar object="Item"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Item Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Items.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Code</th>
								<th>Name</th>
								<th>Category</th>
								<th>UOM</th>
								<th>OEM</th>
								<th class="text-end">Price</th>
								<th>GL Type</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($items as $item)
							<tr>
								<td>{{ $item->id }}</td>
								<td>{{ $item->code }}</td>
								<td><a class="text-info" href="{{ route('items.show',$item->id) }}">{{ $item->name }}</a></td>
								<td>{{ $item->category->name }}</td>
								<td>{{ $item->uom->name }}</td>
								<td>{{ $item->oem->name }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$item->price"/></td>
								<td>{{ $item->glType->name }}</td>
								<td><x-tenant.list.my-boolean :value="$item->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Item" :id="$item->id"/>
									<a href="{{ route('items.destroy',$item->id) }}" class="me-2 sw2-advance"
										data-entity="Item" data-name="{{ $item->name }}" data-status="{{ ($item->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($item->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($item->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $items->links() }}
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

	 @include('shared.includes.js.sw2-advance')

@endsection

