<tr>
	<th class="text-success">Currency :</th>
	<td>
		<select class="form-control" name="currency" required>
			<option value=""><< Currency >> </option>
			@foreach ($currencies as $currency)
				<option value="{{ $currency->currency }}" {{ $currency->currency == old('currency') ? 'selected' : '' }} >{{ $currency->currency." -".$currency->name." (".$currency->country.")" }}</option>
			@endforeach
		</select>
		@error('currency')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
