<!-- Card -->
				<div class="card">
					<div class="card-header border-bottom text-center">
						@if ($formType == 'demo')
							<h3 class="card-header-title">Request a Demo</h3>
						@elseif ($formType =='bug')
							<h3 class="card-header-title">Report a Bug</h3>
						@else
							<h3 class="card-header-title">Contact Us</h3>
						@endif
					</div>

					<div class="card-body">
					<!-- Form -->
					<form action="{{ route('home.save-contact') }}" method="POST" name="myForm" id="myForm" onsubmit="return validateForm()" enctype="multipart/form-data">
						@csrf
						@if ($formType == 'demo')
							 <input type="text" name="type" id="type" class="form-control" placeholder="type" value="demo" hidden>
						@elseif ($formType =='bug')
							<input type="text" name="type" id="type" class="form-control" placeholder="type" value="bug" hidden>
						@else
							<input type="text" name="type" id="type" class="form-control" placeholder="type" value="contact" hidden>
						@endif
						<div class="row gx-3">
						<div class="col-sm-6">
							<!-- Form -->
							<div class="mb-3">
								<label class="form-label" for="first_name">First name</label>
								<input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
									name="first_name" id="first_name" placeholder="First name"
									value="{{ old('first_name', auth()->check() ? auth()->user()->name : '') }}"
									required/>
								@error('first_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>
							<!-- End Form -->
						</div>
						<!-- End Col -->

						<div class="col-sm-6">
							<!-- Form -->
							<div class="mb-3">
								<label class="form-label" for="last_name">Last name</label>
								<input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
									name="last_name" id="last_name" placeholder="Last name"
									value="{{ old('last_name', '' ) }}"/>
								@error('last_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>
							<!-- End Form -->
						</div>
						<!-- End Col -->
						</div>
						<!-- End Row -->

						<div class="row gx-3">
						<div class="col-sm-6">
							<!-- Form -->
							<div class="mb-3">
								<label class="form-label" for="email">Email address</label>
								<input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
									name="email" id="email" placeholder="you@example.com"
									value="{{ old('email', auth()->check() ? auth()->user()->email : '' ) }}"
									required/>
								@error('email')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>
							<!-- End Form -->
						</div>
						<!-- End Col -->

						<div class="col-sm-6">
							<!-- Form -->
							<div class="mb-3">
								<label class="form-label" for="cell">Cell <span class="form-label-secondary">(Optional)</span></label>
								<input type="text" class="form-control form-control-lg @error('cell') is-invalid @enderror"
									name="cell" id="cell" placeholder="+x(xxx)xxx-xx-xx"
									value="{{ old('cell', auth()->check() ? auth()->user()->cell : '' ) }}"/>
								@error('cell')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>
							<!-- End Form -->
						</div>
						<!-- End Col -->
						</div>
						<!-- End Row -->

						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="notes">Details</label>
							<textarea class="form-control form-control-lg @error('notes') is-invalid @enderror"
								name="notes" placeholder="Tell us about your ..." rows="4" required>{{ old('notes', 'Tell us about your ...') }}</textarea>
							@error('notes')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="message">Attachment</label>
							<input type="file" class="form-control form-control-sm" name="file_to_upload"
										id="file_to_upload"
										accept=".docs,.xlsx.jpg,.jpeg,.png,.zip,.rar"
										placeholder="file_to_upload">
							@error('file_to_upload')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->

						<div class="d-grid">
							<button type="submit" class="btn btn-primary btn-lg">Send inquiry</button>
						</div>

						<div class="text-center">
						<p class="form-text">We'll get back to you in 1-2 business days.</p>
						</div>
					</form>
					<!-- End Form -->
					</div>
				</div>
				<!-- End Card -->
