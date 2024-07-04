<div class="row mb-3">
	<div class="col-sm-3 text-end">
		<span class="h6 text-secondary">{{ $label }} X:</span>
	</div>
	<div class="col-sm-9">

	</div>
</div>
<tr>
	<th>{{ $label }} X:</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y', strtotime($value))) : "" }}</td>
</tr>
