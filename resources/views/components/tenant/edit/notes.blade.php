<tr>
	<th class="text-warning">Notes :</th>
	<td>
		<textarea class="form-control" name="notes" placeholder="Enter ..." rows="4">{{ old('notes', $value) }}</textarea>
		@error('notes')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
