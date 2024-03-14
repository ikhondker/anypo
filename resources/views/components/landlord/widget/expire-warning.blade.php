
@inject('carbon', 'Carbon\Carbon')
@if ($account->next_bill_generated)
	<div class="alert alert-soft-info alert-dismissible fade show" role="alert">
		<div class="d-flex">
			<div class="flex-shrink-0">
				<i class="bi-exclamation-triangle-fill"></i>
			</div>
			<div class="flex-grow-1 ms-2">
				<span class="fw-semibold">Information: </span> Your subscription will expire {{  $account->end_date->diffInDays($carbon::now()) }} days. You have an unpaid invoice 		
				<a class="text-danger" href="{{ route('home.invoice', $account->next_invoice_no) }}" target="_blank"> #{{ $account->next_invoice_no }}</a>.
				You might consider paying it.
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
@endif

