@extends('layouts.landlord.app')
@section('title','Topic')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('topics.index') }}" class="text-muted">Topic</a></li>
	<li class="breadcrumb-item active">Create Topic</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Topic</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Topic</h5>
			<h6 class="card-subtitle text-muted">Create New Topic.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('topics.store') }}" method="POST">
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

