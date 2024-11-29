<tr>
	<th>Category X:</th>
	<td>
		<select class="form-control" name="category_id">
			@foreach ($categories as $category)
				<option {{ $category->id == old('category_id', $value) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
			@endforeach
		</select>
	</td>
</tr>
