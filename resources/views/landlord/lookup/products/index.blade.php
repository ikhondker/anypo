@extends('layouts.landlord.app')
@section('title', 'List of Products')
@section('breadcrumb')
	<li class="breadcrumb-item active">Tickets</li>
@endsection

@section('content')

@if (auth()->user()->isSystem())
	<a href="{{ route('products.create') }}" class="btn btn-danger text-white float-end mt-n1"><i class="fas fa-plus"></i> New Product (*)</a>
@endif


	<h1 class="h3 mb-3">All Products</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('products.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-product-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search products…" required>
							<button class="btn" type="submit">
								<i data-lucide="search"></i>
							</button>
						</div>
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@endif
					</form>
					<!--/. form -->
				</div>
				<div class="col-md-6 col-xl-8">
					<div class="text-sm-end">
						<a href="{{ route('products.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('products.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Addon</th>
						<th class="text-end">Month</th>
						<th class="text-end">User</th>
						<th class="text-end">GB</th>
						<th class="text-end">Price</th>
						<th class="text-end">Sold</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('products.show', $product->id) }}">
									<strong>{{ $product->name }}</strong>
								</a>
							</td>
							<td>
								<i data-lucide="check-circle" class="{{$product->addon ? 'text-success' : 'text-secondary' }}"
									data-bs-toggle="tooltip" data-bs-placement="top"
									title="addon"></i>
							</td>
							<td class="text-end"><x-landlord.list.my-integer :value="$product->mnth" /></td>
							<td class="text-end">{{ $product->user }}</td>
							<td class="text-end"> {{ $product->gb }}</td>
							<td class="text-end"><x-landlord.list.my-number :value="$product->price" /></td>
							<td class="text-end"><x-landlord.list.my-integer :value="$product->sold_qty" /></td>
							<td><x-landlord.list.my-enable :value="$product->enable" /></td>
							<td>
								<a href="{{ route('products.show',$product->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
								<a href="{{ route('products.edit',$product->id) }}" class="text-body" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Edit"><i data-lucide="edit"></i></a>
								<a href="{{ route('products.delete', $product->id) }}"
                                    class="text-body sw2-advance" data-entity="Product"
                                    data-name="{{ $product->name }}"
                                    data-status="{{ $product->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ $product->enable ? 'Disable' : 'Enable' }}">
                                    <i data-lucide="{{ $product->enable ? 'bell-off' : 'bell' }} "></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $products->links() }}
			</div>

		</div>
	</div>


@endsection
