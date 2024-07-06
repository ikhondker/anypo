
<tr>
	<th>{{ $label }} X:</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y', strtotime($value))) : "" }}</td>
</tr>
