@extends('layouts.tenant.app')
@section('title','User')

@section('breadcrumb')
	<li class="breadcrumb-item active">Create Support Ticket</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Support Ticket
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Create Support Ticket</h5>
				<h6 class="card-subtitle text-muted">Create a new Support Ticket</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Subject :</th>
							<td>
								<input type="text" class="form-control @error('title') is-invalid @enderror"
								name="title" id="title" placeholder="Summary"
								value="{{ old('title', '' ) }}"
								required/>
							@error('title')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Content :</th>
							<td>
							<textarea class="form-control" rows="3" name="content"
								placeholder="Enter ...">{{ old('content', "Enter ...") }}</textarea>
							@error('content')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Attachment :</th>
							<td>
								<input type="file" class="form-control form-control-sm" name="file_to_upload"
								id="file_to_upload"
								accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
								placeholder="file_to_upload">

								@error('file_to_upload')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
                        <x-tenant.create.save/>

					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection
