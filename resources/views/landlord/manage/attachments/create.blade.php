@extends('landlord.layouts.site-app')
@section('title','Create Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('attachments.index') }}" class="text-muted">Attachments</a></li>
	<li class="breadcrumb-item active">Create Attachment</li>
@endsection

@section('content')


	<div class="card col-8">
		<x-landlord.card.header object="Attachment" title="Create Attachment"/>

		<!-- form start -->
		<form action="{{ route('attachments.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<!-- card-body -->
			<div class="card-body">



				<img src="{{ asset('/landlord/profile/643d1fe033c85.PNG') }}" style="height: 50px;width:100px;">
				<img src="{{ asset('/profile/3334.png') }}" style="height: 50px;width:100px;">
				<img src="{{ Storage::url('app/public/profile/333.png') }}" alt="aaa" style="height: 50px;width:100px;">
				<img src="{{ Storage::url('/landlord/profile/643d1fe033c85.PNG') }}" alt="aaa" style="height: 50px;width:100px;">


				<div class="form-group row mb-4">
					<label for="summary" class="col-sm-2 col-form-label text-end text-secondary">Summary:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="summary" id="summary" placeholder="Type Brief Attachment Description"
							value="{{ old('summary', "Type Brief Attachment Description" ) }}"
							class="@error('summary') is-invalid @enderror">
						@error('summary')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				{{-- <x-file-upload /> --}}
				<x-landlord.attachment.create />

				<div class="form-group row">
					<div class="offset-sm-2 col-sm-10">
						<button type="submit" class="btn btn-info">Save</button>
						<a class="btn btn-dark" href="{{ route('attachments.index') }}"> Cancel</a>
					</div>
				</div>

			</div>
			<!-- /.card-body -->

		</form>
		<!-- /.form end -->



	</div>
@endsection
