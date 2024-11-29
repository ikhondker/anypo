<tr>
	<th class="text-success">Country :</th>
	<td>
		<select class="form-control" name="country" required>
			<option value=""><< Country >> </option>
			@foreach ($countries as $country)
				<option value="{{ $country->country }}" {{ $country->country == old('country') ? 'selected' : '' }} >{{ $country->name }}</option>
			@endforeach
		</select>
	</td>
</tr>
