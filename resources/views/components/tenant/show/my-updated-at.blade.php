<tr>
	<th>Updated At X:</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }}</td>
</tr>
