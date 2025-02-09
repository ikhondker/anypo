@extends('layouts.landlord.app')
@section('title','Edit Tag')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('tags.index') }}" class="text-muted">Tag</a></li>
	<li class="breadcrumb-item active">{{ $tag->name }}</li>
@endsection


@section('content')


	<h1 class="h3 mb-3">Edit Tag</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Tag (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Tag Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('tags.update',$tag->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$tag->id"/>
						<x-landlord.edit.name value="{{ $tag->name }}"/>
						<x-landlord.edit.save/>
					</tbody>
				</table>
			</form>
		</div>
	</div>

@endsection
