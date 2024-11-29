<tr>
	<th>Agent X:</th>
	<td>
		<select class="form-control" name="agent_id" id="agent_id">
			@foreach ($agents as $agent)
				<option {{ $agent->id == old('agent_id', $value) ? 'selected' : '' }} value="{{ $agent->id }}">{{ $agent->name }}</option>
			@endforeach
		</select>
	</td>
</tr>

