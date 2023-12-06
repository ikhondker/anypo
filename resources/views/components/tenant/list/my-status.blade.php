@switch($value)
    @case('APPROVED')
        <span class="badge bg-success">{{ $value }}</span>
        @break
    @case('CLOSED')
        <span class="badge bg-success">{{ $value }}</span>
        @break
    @case('REJECTED')
        <span class="badge bg-danger">{{ $value }}</span>
        @break
    @case('IN-PROCESS')
        <span class="badge bg-warning">{{ $value }}</span>
        @break
    @case('DRAFT')
        <span class="badge bg-info">{{ $value }}</span>
        @break
    @default
        <span class="badge bg-primary">{{ $value }}</span>
@endswitch

