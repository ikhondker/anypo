<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-danger mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('tickets.all') }}"><i class="align-middle me-1" data-lucide="eye"></i> View All(*)</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('tickets.all', ['status'=>  App\Enum\Landlord\TicketStatusEnum::NEW->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Tickets - New</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['status'=>  App\Enum\Landlord\TicketStatusEnum::ASSIGNED->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Tickets - Assigned</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['status'=>  App\Enum\Landlord\TicketStatusEnum::PENDING->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Tickets - Pending</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['status'=>  App\Enum\Landlord\TicketStatusEnum::INPROGRESS->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Tickets - In-Progress</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['status'=>  App\Enum\Landlord\TicketStatusEnum::DEVELOPMENT->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Tickets - Development</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['status'=>  App\Enum\Landlord\TicketStatusEnum::CLOSED->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Tickets - Closed</a>

		{{-- <div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SUBSCRIPTION->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> TO By Type(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SIGNUP->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Signups(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SUBSCRIPTION->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Subscription(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::ADVANCE->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View ADVANCE(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::ADDON->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View ADDON(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SETUP->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View SETUP(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SUPPORT->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View SUPPORT(*)</a>
		<a class="dropdown-item" href="{{ route('tickets.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::AMC->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View AMC(*)</a> --}}
	</div>
</div>
