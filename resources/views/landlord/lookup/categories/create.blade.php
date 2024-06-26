@extends('layouts.landlord.app')
@section('title','Category')
@section('breadcrumb','Create Category')

@section('content')

	<h1 class="h3 mb-3">Create Category</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Category</h5>
			<h6 class="card-subtitle text-muted">Create New Category.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('categories.store') }}" method="POST">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.create.name/>
					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection

