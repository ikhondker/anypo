<tr>
	<th>Content X:</th>
	<td>
		<textarea class="form-control" rows="5" name="content"
			placeholder="Enter ...">{{ old('content', "Enter ...") }}</textarea>
		@error('content')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
