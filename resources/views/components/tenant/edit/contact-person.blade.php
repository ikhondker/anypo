<tr>
	<th class="text-warning">Contact Person :</th>
	<td>
		<input type="text" class="form-control @error('contact_person') is-invalid @enderror"
			name="contact_person" id="contact_person" placeholder="Contact Persone"
			value="{{ old('contact_person', $value ) }}"
			/>
		@error('contact_person')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
