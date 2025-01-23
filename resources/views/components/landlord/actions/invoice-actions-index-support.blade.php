<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-danger mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('invoices.all') }}"><i class="align-middle me-1" data-lucide="eye"></i> View All(*)</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SIGNUP->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Signups(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SUBSCRIPTION->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Subscription(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::ADVANCE->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View ADVANCE(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::ADDON->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View ADDON(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SETUP->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View SETUP(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::SUPPORT->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View SUPPORT(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['type'=>  App\Enum\Landlord\InvoiceTypeEnum::AMC->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View AMC(*)</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.all', ['status'=>  App\Enum\Landlord\InvoiceStatusEnum::DRAFT->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View DRAFT(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['status'=>  App\Enum\Landlord\InvoiceStatusEnum::DUE->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View DUE(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['status'=>  App\Enum\Landlord\InvoiceStatusEnum::PAID->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View PAID(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.all', ['status'=>  App\Enum\Landlord\InvoiceStatusEnum::CANCELED->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> View CANCELED(*)</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.all', ['status'=>  App\Enum\Landlord\InvoiceStatusEnum::CANCELED->value ]) }}"><i class="align-middle me-1" data-lucide="eye"></i> Pwop*(*)</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="align-middle me-1" data-lucide="eye"></i> Generate Invoice **(*)</a>
		<a class="dropdown-item" href="{{ route('invoices.create') }}"><i class="align-middle me-1" data-lucide="eye"></i> Create Service Invoice(*)</a>
	</div>
</div>
