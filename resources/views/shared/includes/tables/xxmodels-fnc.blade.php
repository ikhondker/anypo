 <table class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="">#</th>
			<th class="">Name</th>
			<th class="">Method Name</th>
			<th class="">Days Ago</th>
			<th class="">Days</th>
			<th class="">Jump</th>
		</tr>
	</thead>

	<tbody>

		<!-- ========== INCLUDE ========== -->
		@include('shared.includes.tables.seeded-methods')
		<!-- ========== INCLUDE ========== -->

		@foreach ($filesInFolder as $row)
			@php
			//$class = new ReflectionClass('App\Http\Controllers\Tenant\HomeController');
			//$class = new ReflectionClass('App\Models\Tenant\\'. $row["f"]);
			$class = new ReflectionClass(config('akk.DOC_DIR_MODEL') .'\\'. $row["f"]);
			$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
			@endphp
			@foreach ($methods as $method)
				@php
					if  (!in_array($method->name, $exclude)) {
				@endphp
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td class="">{{ $row['f'] }}</td>
						<td class="">	{{ $method->name }}</td>
						<td class="text-start"></td>
						<td class="text-start"></td>
						<td class="text-start"></td>
					</tr>
					@php
					}
					@endphp

			@endforeach
		@endforeach
	</tbody>

</table>