<table class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="">#</th>
			<th class="">Name</th>
			<th class="">Object/Model</th>
			<th class="">Route</th>
			<th class="">Functions</th>
			<th class="">Days Ago</th>
			<th class="">Days</th>
			<th class="">Jump</th>
		</tr>
	</thead>

	<tbody>

		@foreach ($filesInFolder as $row)
			<tr>
				<th scope="row">{{ $loop->iteration }}</th>
				<td class="">{{ $row['f'] }}</td>
				<td class="">&nbsp;</td>
				<td class="">&nbsp;</td>
				<td class="">&nbsp;</td>
				<td class="text-start">
					@if ($row['days'] < 7)
						<span class="text-danger"> {{ $row['last_modified_human'] }} <span>
					@else
						{{ $row['last_modified_human'] }}
					@endif
				</td>
				<td class="text-start">{{ $row['days'] }}</td>
				<td class="">&nbsp;</td>
			</tr>
		@endforeach
	</tbody>

</table>