<tr>
	<th class="text-warning">Country :</th>
	<td>
		<select class="form-control" name="country">
			@foreach ($countries as $country)
				<option {{ $country->country == old('country',$value) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }}</option>
			@endforeach
		</select>
	</td>
</tr>
