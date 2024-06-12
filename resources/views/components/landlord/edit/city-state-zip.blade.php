<tr>
	<th>City-State-Zip</th>
	<td>
		<div class="row">
			<div class="col-md-5">
				<input type="text" class="form-control @error('city') is-invalid @enderror"
				name="city" id="city" placeholder="City"
				value="{{ old('city', $city ) }}"
				required/>
				@error('city')
					<div class="text-danger text-xs">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control @error('state') is-invalid @enderror"
					name="state" id="state" placeholder="N/A"
					style="text-transform: uppercase"
					value="{{ old('state', $state ) }}"
					required/>
				@error('state')
					<div class="text-danger text-xs">{{ $message }}</div>
				@enderror
			</div>
		<div class="col-md-3">
			<input type="text" class="form-control @error('zip') is-invalid @enderror"
				name="zip" id="zip" placeholder="1234"
				value="{{ old('zip', $zip ) }}"
				required/>
				@error('zip')
					<div class="text-danger text-xs">{{ $message }}</div>
				@enderror
		</div>
	</div>
	</td>
</tr>
