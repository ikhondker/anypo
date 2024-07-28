@extends('layouts.landlord.app')
@section('title','Edit Product')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-muted">Products</a></li>
	<li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">Edit Product</h1>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Edit Product (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Product Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.edit.id-read-only :value="$product->id"/>
						<x-landlord.edit.name value="{{ $product->name }}"/>

						<tr>
							<th>Mnth :</th>
							<td>
								<input type="number" class="form-control @error('mnth') is-invalid @enderror"
								name="mnth" id="mnth" placeholder="Name"
								value="{{ old('mnth', $product->mnth ) }}"
								required/>
							@error('mnth')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Users :</th>
							<td>
								<input type="number" class="form-control @error('mnth') is-invalid @enderror"
										name="user" id="user" placeholder="Name"
										value="{{ old('user', $product->user ) }}"
										required/>
									@error('user')
										<div class="small text-danger">{{ $message }}</div>
									@enderror

							</td>
						</tr>
						<tr>
							<th>GB :</th>
							<td>
								<input type="number" class="form-control @error('gb') is-invalid @enderror"
										name="gb" id="gb" placeholder="Name"
										value="{{ old('gb', $product->gb ) }}"
										required/>
									@error('gb')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<tr>
							<th>Price :</th>
							<td>
								<input type="text" class="form-control @error('price') is-invalid @enderror"
										name="price" id="price" placeholder="Name"
										value="{{ old('price', $product->price ) }}"
										required/>
									@error('price')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<x-landlord.edit.notes value="{{ $product->notes }}"/>


					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
