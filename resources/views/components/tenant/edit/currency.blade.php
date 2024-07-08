<tr>
	<th>Currency X:</th>
	<td>
		<select class="form-control" name="currency" id="currency" required>
			@foreach ($currencies as $currency)
				<option {{ $currency->currency == old('currency',$value) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->currency." -".$currency->name." (".$currency->country.")" }} </option>
			@endforeach
		</select>
		@error('currency')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
</tr>
