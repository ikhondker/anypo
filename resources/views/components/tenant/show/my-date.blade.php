
<tr>
	<th class="text-danger">{{ $label }} :</th>
	<td>{{ ($value <> "") ? strtoupper(date('d-M-Y', strtotime($value))) : "" }}</td>
</tr>
