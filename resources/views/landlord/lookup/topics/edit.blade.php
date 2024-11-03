@extends('layouts.landlord.app')
@section('title','Edit Topic')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('topics.index') }}" class="text-muted">Topic</a></li>
	<li class="breadcrumb-item active">{{ $topic->name }}</li>
@endsection


@section('content')


	<h1 class="h3 mb-3">Edit Topic</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Topic (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Topic Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('topics.update',$topic->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$topic->id"/>
						<x-landlord.edit.name value="{{ $topic->name }}"/>
					</tbody>
				</table>
				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
