@extends('layouts.landlord-app')
@section('title','Edit Template')
@section('breadcrumb','Edit Templates v1.3 (19-SEP-23)')

@section('content')


	<!-- Card -->
	<div class="card">

		<form action="{{ route('templates.update',$template->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Template</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">
			

				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label">Profile photo</label>

					<div class="col-sm-9">
					<!-- Media -->
					<div class="d-flex align-items-center">
						<!-- Avatar -->
						<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
						<img id="avatarImg" class="avatar-img" src="{{ asset('/assets/img/160x160/img9.jpg') }}" alt="Image Description">
						</label>

						<div class="d-grid d-sm-flex gap-2 ms-4">
						<div class="form-attachment-btn btn btn-primary btn-sm">Upload photo
							<input type="file" class="js-file-attach form-attachment-btn-label" id="avatarUploader"
								data-hs-file-attach-options='{
									"textTarget": "#avatarImg",
									"mode": "image",
									"targetAttr": "src",
									"resetTarget": ".js-file-attach-reset-img",
									"resetImg": "./assets/img/160x160/img1.jpg",
									"allowTypes": [".png", ".jpeg", ".jpg"]
								}'>
						</div>
						<!-- End Avatar -->

						<button type="button" class="js-file-attach-reset-img btn btn-white btn-sm">Delete</button>
						</div>
					</div>
					<!-- End Media -->
					</div>
				</div>
				<!-- End Form -->

				<x-landlord.edit.id-read-only :value="$template->id"/>
				<x-landlord.edit.name :value="$template->name"/>
				<x-landlord.edit.email :value="$template->email"/>
				<x-landlord.edit.cell value="{{ $template->cell }}"/>
				<x-landlord.edit.address1 value="{{ $template->address1 }}"/>
				<x-landlord.edit.address2 value="{{ $template->address2 }}"/>
				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label"></label>
					<div class="col-sm-9">
						<div class="row">
							<x-landlord.edit.city value="{{ $template->city }}"/>
							<x-landlord.edit.state value="{{ $template->state }}"/>
							<x-landlord.edit.zip value="{{ $template->zip }}"/>
						</div>
					</div>
				</div>
				<!-- End Form -->
				<x-landlord.edit.country :value="$template->country"/>

					{{-- Old FORMAT bellow ------     --}}
					<div class="form-group row">
						<label for="summary" class="col-sm-3 col-form-label col-form-label-sm">Summary:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control form-control-sm" 
								name="summary" id="summary" placeholder="Summary" 
								value="{{ old('summary', $template->summary ) }}"     
								class="@error('summary') is-invalid @enderror" required>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="code" class="col-sm-3 col-form-label col-form-label-sm">Code:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control form-control-sm" 
								name="code" id="code" placeholder="Code" 
								style="text-transform: uppercase"
								value="{{ old('code', $template->code ) }}"     
								class="@error('code') is-invalid @enderror" required>
							@error('code')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div>
	
					<div class="form-group row">
						<label for="user_id" class="col-sm-3 col-form-label col-form-label-sm">User</label>
						<div class="col-sm-9">
							<select class="form-control" name="user_id">
								@foreach ($users as $template)
								<option {{ $template->id == old('user_id',$template->user_id) ? 'selected' : '' }} value="{{ $template->id }}">{{ $template->name }} </option>
								@endforeach
							</select>
						</div>
					</div>
	
					<div class="form-group row">
						<label for="my_enum" class="col-sm-3 col-form-label col-form-label-sm">Role</label>
						<div class="col-sm-9">
							<select class="form-control" name="my_enum" placeholder="Enum" value="template">
								<option {{ 'template' == old('my_enum',$template->my_enum) ? 'selected' : '' }}  value="template"  >User</option>
								<option {{ 'agent' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="agent">Agent</option>
								<option {{ 'admin' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="admin">Admin</option>
								<option {{ 'system' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="system">System</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="qty" class="col-sm-3 col-form-label col-form-label-sm">Qty</label>
						<div class="col-sm-9">
							<input type="number" class="form-control form-control-sm" 
								name="qty" id="qty" placeholder="1"
								value="{{ old('qty', $template->qty ) }}"
								style="text-align: right;" min="1" 
								class="@error('qty') is-invalid @enderror">
							@error('qty')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div>
	
					<div class="form-group row">
						<label for="lnpage" class="col-sm-3 col-form-label col-form-label-sm">Amount</label>
						<div class="col-sm-9">
							<input type="number" class="form-control form-control-sm" 
								name="amount" id="amount" placeholder="1.00" 
								style="text-align: right;" step='0.01' min="1"
								value="{{ old('amount', $template->amount ) }}"     
								class="@error('amount') is-invalid @enderror">
							@error('amount')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div>


					<div class="form-group row">
						<label for="summary" class="col-sm-3 col-form-label col-form-label-sm">Notes:</label>
						<div class="col-sm-9">
							
								<textarea class="form-control form-control-sm" rows="3" name="notes" 
								placeholder="Enter ...">{{ old('notes', $template->notes) }}</textarea>
		
						</div>
					</div>
		
					<div class="form-group row">
						<label for="name" class="col-sm-3 col-form-label col-form-label-sm">Image</label>
						<div class="col-sm-9">
							<x-landlord.attachment.create />
						</div>
					</div>


					<div class="form-group row">
						<label for="my_date" class="col-sm-3 col-form-label col-form-label-sm">Date</label>
						<div class="col-sm-9">
							<input type="date" class="form-control form-control-sm" 
								name="my_date" id="my_date" placeholder="" 
								value="{{ old('my_date', $template->my_date ) }}"
								class="@error('my_date') is-invalid @enderror">
							@error('my_date')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							
						</div>
					</div>
		
					<div class="form-group row">
						<label for="lnpage" class="col-sm-3 col-form-label col-form-label-sm">DateTime</label>
						<div class="col-sm-9">
							<input type="date" class="form-control form-control-sm" 
								name="my_date_time" id="my_date_time" placeholder="" 
								value="{{ old('my_date_time',$template->my_date_time) }}"
								class="@error('my_date_time') is-invalid @enderror">
							@error('my_date_time')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div>
		
					<div class="form-group row">
						<label for="lnpage" class="col-sm-3 col-form-label col-form-label-sm">Boolean</label>
						<div class="col-sm-9">
							<input type="checkbox" name="my_bool" id="my_bool"  @checked($template->my_bool)/>
							<label class="form-check-label" for="form-check-default-checked">
								Active
							</label>
		
						</div>
					</div>

			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->


@endsection
