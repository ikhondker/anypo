<tr>
	<th class="text-success">Contact Person :</th>
	<td>
		<input type="text" class="form-control @error('contact_person') is-invalid @enderror"
			name="contact_person" id="contact_person" placeholder="Contact Person"
			value="{{ old('contact_person', '' ) }}"
			required/>
		@error('contact_person')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
