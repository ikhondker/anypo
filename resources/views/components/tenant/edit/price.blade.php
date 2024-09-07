<tr>
	<th class="text-warning">Price ({{ $_setup->currency }}) :</th>
	<td>
		<input type="number" class="form-control @error('price') is-invalid @enderror"
			name="price" id="price" placeholder="99,999.99"
			{{-- value="{{ number_format(old('price', $value ),2) }}" --}}
			value="{{ old('price', $value) }}"
			step='0.01' min="1" required/>
		@error('price')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
