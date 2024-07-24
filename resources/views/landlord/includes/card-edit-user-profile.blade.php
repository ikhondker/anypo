
<div class="card">
	<div class="card-header">
		<h5 class="card-title">Edit User Profile</h5>
		<h6 class="card-subtitle text-muted">Edit User Profile.</h6>
	</div>
	<div class="card-body">
		<form id="myform" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<input type="hidden" name="id" value="{{ $user->id }}">

			<table class="table table-sm my-2">
				<tbody>
					<tr>
						<th width="30%">Photo</th>
						<td>
							<div class="">
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle img-responsive mt-2" width="128" height="128" />
								<div class="mt-2">
									<input type="file" id="file_to_upload" name="file_to_upload"
									accept=".jpg,.jpeg,.png,.gif"
									placeholder="file_to_upload"
									onchange="mySubmit()" style="display:none;" />
									<a href="" class="btn btn-primary mt-n1" onclick="document.getElementById('file_to_upload').click(); return false">
										<i class="fas fa-upload"></i> Upload</a>
								</div>
								<small>For best results, use an image at least 128px by 128px in .jpg format</small>
							</div>
						</td>
					</tr>
					<x-landlord.edit.name :value="$user->name"/>
					<tr>
						<th>Email :</th>
						<td><input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" value="{{ $user->email }}" readonly>
						</td>
					</tr>
					<x-landlord.edit.cell value="{{ $user->cell }}"/>
					<x-landlord.edit.address1 value="{{ $user->address1 }}"/>
					<x-landlord.edit.address2 value="{{ $user->address2 }}"/>
					<x-landlord.edit.city-state-zip city="{{ $user->city }}" state="{{ $user->state }}" zip="{{ $user->zip }}"/>
					<x-landlord.edit.country :value="$user->country"/>
					<tr>
						<th>Facebook :</th>
						<td>
							<input type="text" class="form-control @error('facebook') is-invalid @enderror"
							name="facebook" id="facebook" placeholder="https://www.facebook.com/username"
							value="{{ old('facebook', $user->facebook ) }}"
							/>
						@error('facebook')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
						</td>
					</tr>
					<tr>
						<th>Linkedin :</th>
						<td>
							<input type="text" class="form-control @error('linkedin') is-invalid @enderror"
							name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username"
							value="{{ old('linkedin', $user->linkedin ) }}"
							/>
						@error('linkedin')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
						</td>
					</tr>
					<x-landlord.edit.notes value="{{ $user->notes }}"/>
				</tbody>
			</table>

			<x-landlord.edit.save/>
		</form>
	</div>
</div>

