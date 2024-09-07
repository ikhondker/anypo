<tr>
	<th class="text-danger">{{ $label }} :</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }}</td>
</tr>
