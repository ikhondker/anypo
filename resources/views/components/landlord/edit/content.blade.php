<tr>
	<th>Content X:</th>
	<td>
		<textarea class="form-control" name="content"placeholder="Enter ..." rows="5">{{ old('content', $value) }}</textarea>
		@error('content')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>


