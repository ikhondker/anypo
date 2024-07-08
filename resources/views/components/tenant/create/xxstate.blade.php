<div class="mb-3 col-md-4">
	<label for="state" class="form-label">State</label>
	<input type="text" class="form-control @error('state') is-invalid @enderror"
		name="state" id="state" placeholder="N/A"
		style="text-transform: uppercase"
		value="{{ old('state', 'NA' ) }}"
		required/>
	@error('state')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>
<tr>
	<th></th>
	<td>

	</td>
</tr>
