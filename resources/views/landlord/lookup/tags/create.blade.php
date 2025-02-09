@extends('layouts.landlord.app')
@section('title','Tag')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tags.index') }}" class="text-muted">Tag</a></li>
	<li class="breadcrumb-item active">Create Tag</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Tag</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Tag</h5>
			<h6 class="card-subtitle text-muted">Create New Tag.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('tags.store') }}" method="POST">
				@csrf

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.create.name/>
						<x-landlord.edit.save/>
					</tbody>
				</table>

			</form>
		</div>
	</div>

@endsection

