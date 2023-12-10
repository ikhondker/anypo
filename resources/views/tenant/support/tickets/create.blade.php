@extends('layouts.app')
@section('title','User')
@section('breadcrumb','Create Ticket')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Ticket
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="User"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Create Ticket</h5>
					</div>
					<div class="card-body">
						
						<div class="mb-3">
							<label class="form-label">Title</label>
							<input type="text" class="form-control @error('title') is-invalid @enderror" 
								name="title" id="title" placeholder="Summary"     
								value="{{ old('title', '' ) }}"
								required/>
							@error('title')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Content</label>
							<textarea class="form-control" rows="3" name="content" 
								placeholder="Enter ...">{{ old('content', "Enter ...") }}</textarea>
							@error('content')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
						<div class="mb-3">
							<label class="form-label">Attachment</label>
							<input type="file" class="form-control form-control-sm" name="file_to_upload" 
							id="file_to_upload" 
							accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" 
							placeholder="file_to_upload">
					
							@error('file_to_upload')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.widgets.submit/>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection