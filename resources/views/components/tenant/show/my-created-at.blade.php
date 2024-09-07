<tr>
	<th class="text-danger">Created At :</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }}</td>
</tr>
