<div class="row mb-3">
	<div class="col-sm-3 text-end">
		<span class="h6 text-secondary"></span>
	</div>
	<div class="col-sm-9">

	</div>
</div>
<tr>
	<th>Created At X:</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }}</td>
</tr>
