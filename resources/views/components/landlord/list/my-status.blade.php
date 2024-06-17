@switch($value)
	@case('APPROVED')
		<span class="badge badge-subtle-success">{{ $value }}</span>
		@break
	@case('CLOSED')
		<span class="badge badge-subtle-success">{{ $value }}</span>
		@break
	@case('REJECTED')
		<span class="badge badge-subtle-danger">{{ $value }}</span>
		@break
	@case('IN-PROCESS')
		<span class="badge badge-subtle-warning">{{ $value }}</span>
		@break
	@case('DRAFT')
		<span class="badge badge-subtle-info">{{ $value }}</span>
		@break
	@default
		<span class="badge badge-subtle-primary">{{ $value }}</span>
@endswitch

