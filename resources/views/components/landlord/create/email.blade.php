 <!-- Form -->
 <div class="row mb-4">
		<label for="email" class="col-sm-3 col-form-label form-label">Email X:</label>

		<div class="col-sm-9">
			<input type="email" class="form-control @error('email') is-invalid @enderror" 
						name="email" id="email" placeholder="you@example.com"     
						value="{{ old('email', '' ) }}"
						required/>
				@error('email')
						<div class="text-danger text-xs">{{ $message }}</div>
				@enderror

		</div>
	</div>
	<!-- End Form -->