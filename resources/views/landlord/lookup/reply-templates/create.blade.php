@extends('layouts.landlord.app')
@section('title','Reply Template')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('reply-templates.index') }}" class="text-muted">Reply Template</a></li>
	<li class="breadcrumb-item active">Create Reply Template</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Reply Template</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Reply Template</h5>
			<h6 class="card-subtitle text-muted">Create New Reply Template.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('reply-templates.store') }}" method="POST">
				@csrf


				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.create.name/>

						<tr>
							<th class="text-success">Notes :</th>
							<td>
								<textarea class="form-control" name="notes" placeholder="Enter ..."
								rows="3">{{ old('notes', 'Enter ...') }}</textarea>
							</td>
						</tr>


					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection

