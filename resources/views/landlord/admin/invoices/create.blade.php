@extends('layouts.landlord.app')
@section('title','Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Category</a></li>
	<li class="breadcrumb-item active">Create Category</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Category</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Category</h5>
			<h6 class="card-subtitle text-muted">Create New Category.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('invoices.store') }}" method="POST">
				@csrf
				

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

