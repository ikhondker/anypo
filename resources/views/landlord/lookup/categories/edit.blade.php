@extends('layouts.landlord.app')
@section('title','Edit Category')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">Category</a></li>
	<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection


@section('content')


	<h1 class="h3 mb-3">Edit Category</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Category (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Category Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$category->id"/>
						<x-landlord.edit.name value="{{ $category->name }}"/>
					</tbody>
				</table>
				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
