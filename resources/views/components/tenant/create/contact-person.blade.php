<div class="mb-3">
	<label class="form-label">Contact Person</label>
	<input type="text" class="form-control @error('contact_person') is-invalid @enderror"
		name="contact_person" id="contact_person" placeholder="Contact Person"
		value="{{ old('contact_person', '' ) }}"
		required/>
	@error('contact_person')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>