<tr>
	<th>Priority X:</th>
	<td>
		<select class="form-control" name="priority_id">
			@foreach ($priorities as $priority)
				<option {{ $priority->id == old('priority_id',$value) ? 'selected' : '' }} value="{{ $priority->id }}">{{ $priority->name }}</option>
			@endforeach
		</select>
	</td>
</tr>




