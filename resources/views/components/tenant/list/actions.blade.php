@if ($show)
    <a wire:ignore href="{{ route($route.'.show',$id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
        <i class="align-middle" data-feather="eye"></i></a>
@endif

@if ($edit)
    <a wire:ignore href="{{ route($route.'.edit',$id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
        <i class="align-middle" data-feather="edit"></i></a>
@endif

@if ($enable)
    <a wire:ignore href="{{ route($route.'.destroy',$id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Are you sure?')" title="Enable/Disable">
        <i class="align-middle" data-feather="bell-off"></i>
    </a>
@endif

