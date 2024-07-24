@extends('layouts.landlord.app')
@section('title','Edit Attachment')
@section('breadcrumb','Edit Attachment')

@section('content')

	<h1 class="h3 mb-3">Edit Attachment</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Attachment (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Attachment Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('attachments.update',$attachment->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.edit.id-read-only :value="$attachment->id"/>

							<tr>
								<th>Summary:</th>
								<td>
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="summary"
										value="{{ old('summary', $attachment->summary) }}"
										required/>
									@error('summary')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Article ID :</th>
								<td>
									<input type="text" class="form-control @error('article_id') is-invalid @enderror"
										name="article_id" id="article_id" placeholder="article_id"
										value="{{ old('article_id', $attachment->article_id) }}"
										required/>
									@error('article_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>

							<tr>
								<th>File Entity:</th>
								<td>
									<input type="text" class="form-control @error('file_entity') is-invalid @enderror"
										name="file_entity" id="file_entity" placeholder="file_entity"
										value="{{ old('file_entity', $attachment->file_entity) }}"
										required/>
									@error('file_entity')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>

							<tr>
								<th>Owner ID :</th>
								<td>
									<input type="text" class="form-control @error('owner_id') is-invalid @enderror"
										name="owner_id" id="owner_id" placeholder="owner_id"
										value="{{ old('owner_id', $attachment->owner_id) }}"
										required/>
									@error('owner_id')
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
