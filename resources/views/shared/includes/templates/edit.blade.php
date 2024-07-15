

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

				<x-tenant.edit.city-state-zip city="{{ $template->city }}" state="{{ $template->state }}" zip="{{ $template->zip }}"/>

				<x-landlord.edit.country :value="$template->country"/>

					{{-- Old FORMAT bellow --------}}
					<div class="form-group row">
						<label for="summary" class="col-sm-3 col-form-label col-form-label-sm">Summary:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control form-control-sm"
								name="summary" id="summary" placeholder="Summary"
								value="{{ old('summary', $template->summary ) }}"
								class="@error('summary') is-invalid @enderror" required>
							@error('summary')
								<div class="small text-danger">{{ $message }}</div>
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
								<div class="small text-danger">{{ $message }}</div>
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
								<option {{ 'template' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="template" >User</option>
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
								<div class="small text-danger">{{ $message }}</div>
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
								<div class="small text-danger">{{ $message }}</div>
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
								<div class="small text-danger">{{ $message }}</div>
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
								<div class="small text-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="lnpage" class="col-sm-3 col-form-label col-form-label-sm">Boolean</label>
						<div class="col-sm-9">
							<input type="checkbox" name="my_bool" id="my_bool" @checked($template->my_bool)/>
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

	<!-- form start -->
	<form id="myform" action="{{ route('templates.update',$template->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Template Info</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">

								<div class="mb-3">
									<label class="form-label">ID</label>
									<input type="text" class="form-control" placeholder="ID" value="{{ old('id', $template->id ) }}" readonly>
								</div>

								<div class="mb-3">
									<label class="form-label">Full Name</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror"
										name="name" id="name" placeholder="Full Name"
										value="{{ old('name', $template->name ) }}"
										required/>
									@error('name')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label class="form-label">Summary</label>
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="Summary"
										value="{{ old('summary', $template->summary ) }}"
										required/>
									@error('summary')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label class="form-label">Email</label>
									<input type="email" class="form-control @error('email') is-invalid @enderror"
										name="email" id="email" placeholder="name@company.com"
										value="{{ old('email', $template->email ) }}"
										required/>
									@error('email')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>


								<div class="mb-3">
									<label class="form-label">Cell</label>
									<input type="text" class="form-control @error('cell') is-invalid @enderror"
										name="cell" id="cell" placeholder="01911310509"
										value="{{ old('cell', $template->cell ) }}"
										required/>
									@error('cell')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<x-tenant.buttons.show.save/>


						</div>
					</div>
				</div>
				<!-- end col -->
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Address</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">

								<div class="mb-3">
									<label class="form-label">Address 1</label>
									<input type="text" class="form-control @error('address1') is-invalid @enderror"
										name="address1" id="address1" placeholder="Address 1"
										value="{{ old('address1', $template->address1 ) }}"
										required/>
									@error('address1')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Address 2</label>
									<input type="text" class="form-control @error('address2') is-invalid @enderror"
										name="address2" id="address2" placeholder="Address 2"
										value="{{ old('address2', $template->address2 ) }}"
										required/>
									@error('address2')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Zip</label>
									<input type="text" class="form-control @error('zip') is-invalid @enderror"
										name="zip" id="zip" placeholder="1234"
										value="{{ old('zip', $template->zip ) }}"
										required/>
									@error('zip')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">State</label>
									<input type="text" class="form-control @error('state') is-invalid @enderror"
										name="state" id="state" placeholder="N/A"
										value="{{ old('state', $template->state ) }}"
										required/>
									@error('state')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Country</label>
									<select class="form-control" name="country">
										@foreach ($countries as $country)
											<option {{ $country->country == old('country',$template->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
										@endforeach
									</select>
								</div>



						</div>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Dropdowns</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">

								<div class="mb-3">
									<label class="form-label">Code</label>
									<input type="text" class="form-control @error('code') is-invalid @enderror"
										name="code" id="code" placeholder="XX01"
										style="text-transform: uppercase"
										value="{{ old('code', $template->code ) }}"
										required/>
									@error('code')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>


								<div class="mb-3">
									<label class="form-label">User</label>
									<select class="form-control" name="user_id">
										@foreach ($users as $user)
										<option {{ $user->id == old('user_id',$template->user_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
										@endforeach
									</select>
								</div>

								<div class="mb-3">
									<label class="form-label">Role</label>
									<select class="form-control" name="my_enum" placeholder="Enum" value="user">
										<option {{ 'user' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="user" >User</option>
										<option {{ 'agent' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="agent">Agent</option>
										<option {{ 'admin' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="admin">Admin</option>
										<option {{ 'system' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="system">System</option>
									</select>
								</div>


						</div>
					</div>
				</div>
				<!-- end col -->
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Amount</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">Qty</label>
								<input type="number" class="form-control @error('qty') is-invalid @enderror"
									name="qty" id="qty" placeholder="1"
									value="{{ old('qty', $template->qty ) }}"
									min="1" required/>
								@error('qty')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Amount</label>
								<input type="number" class="form-control @error('amount') is-invalid @enderror"
									name="amount" id="amount" placeholder="XX01"
									value="{{ old('amount', $template->amount ) }}"
									step='0.01' min="1" required/>
								@error('amount')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Notes:</label>
								<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', $template->notes) }}</textarea>
								@error('notes')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

						</div>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Profile Image</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<x-tenant.attachment.create />
							</div>

							<div class="mb-3">
								<label class="form-label">Notes</label>
								<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', $template->notes) }}</textarea>
							</div>
						</div>
					</div>
				</div>
				<!-- end col -->
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Date</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">Date</label>
								<input type="date" class="form-control @error('my_date') is-invalid @enderror"
									name="my_date" id="my_date" placeholder=""
									value="{{ old('my_date', $template->my_date ) }}"
									required/>
								@error('my_date')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Date</label>
								<input type="date" class="form-control @error('my_date_time') is-invalid @enderror"
									name="my_date_time" id="my_date_time" placeholder=""
									value="{{ old('my_date_time', $template->my_date_time ) }}"
									required/>
								@error('my_date_time')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-check m-0">
								<input type="checkbox" class="form-check-input"
								name="my_bool" id="my_bool" @checked($template->my_bool)/>
								<span class="form-check-label"> Active?</span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

	</form>
	<!-- /.form end -->
