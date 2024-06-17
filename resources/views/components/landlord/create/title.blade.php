<tr>
	<th>Title X:</th>
	<td>
		<input type="text" class="form-control @error('title') is-invalid @enderror"
			name="title" id="title" placeholder="Summary"
			value="{{ old('title', '' ) }}"
			required/>
		@error('title')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
