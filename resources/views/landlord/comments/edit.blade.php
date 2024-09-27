@extends('layouts.landlord.app')
@section('title','Edit Comment')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('comments.index') }}" class="text-muted">Comment</a></li>
	<li class="breadcrumb-item active">{{ $comment->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">Edit Comment</h1>
	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Comment (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Comment Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('comments.update',$comment->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$comment->id"/>
						<x-landlord.edit.content value="{{ $comment->content }}"/>
					</tbody>
				</table>
				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
