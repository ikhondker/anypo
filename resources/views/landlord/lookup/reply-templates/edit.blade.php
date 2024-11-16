@extends('layouts.landlord.app')
@section('title','Edit Reply Template')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('reply-templates.index') }}" class="text-muted">Reply Template</a></li>
	<li class="breadcrumb-item active">{{ $replyTemplate->name }}</li>
@endsection


@section('content')


	<h1 class="h3 mb-3">Edit Reply Template</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Reply Template</h5>
			<h6 class="card-subtitle text-muted">Edit Reply Template Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('reply-templates.update',$replyTemplate->id) }}" method="POST">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$replyTemplate->id"/>
						<x-landlord.edit.name value="{{ $replyTemplate->name }}"/>
						<tr>
							<th>Message :</th>
							<td>
								<textarea class="form-control" name="notes" placeholder="Enter ..." rows="4">{{ old('notes', $replyTemplate->notes) }}</textarea>
								@error('notes')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

					</tbody>
				</table>
				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
