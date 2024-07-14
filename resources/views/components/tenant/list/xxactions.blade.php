@if ($show)
	<a href="{{ route($route.'.show',$id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
		<i class="align-middle" data-lucide="eye"></i></a>
@endif

@if ($edit)
	<a href="{{ route($route.'.edit',$id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
		<i class="align-middle" data-lucide="edit"></i></a>
@endif

@if ($enable)
	<a href="{{ route($route.'.destroy',$id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Are you sure?')" title="Enable/Disable">
		<i class="align-middle" data-lucide="bell-off"></i>
	</a>
@endif

