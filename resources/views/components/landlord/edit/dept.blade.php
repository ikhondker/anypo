<tr>
	<th>Dept X:</th>
	<td>
		<select class="form-control" name="dept_id">
			@foreach ($depts as $dept)
				<option {{ $dept->id == old('dept_id', $value) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }}</option>
			@endforeach
		</select>
	</td>
</tr>




