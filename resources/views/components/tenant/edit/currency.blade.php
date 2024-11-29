<tr>
	<th class="text-warning">Currency :</th>
	<td>
		<select class="form-control" name="currency" id="currency" required>
			@foreach ($currencies as $currency)
				<option {{ $currency->currency == old('currency',$value) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->currency." -".$currency->name." (".$currency->country.")" }}</option>
			@endforeach
		</select>
		@error('currency')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
