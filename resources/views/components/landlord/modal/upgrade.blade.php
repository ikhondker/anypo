<!-- Modal -->
<div class="modal fade" id="s{{ $code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h1 class="modal-title fs-5" id="exampleModalLabel"> <i data-feather="edit" class="fea text-muted"></i>Upgrade Service</h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<h4 class="modal-title w-100">Are you sure?</h4>	
			This will upgrade your package immidiately. However, You will be billed on revised rate form your next bill cycle. Do you want to proceed?
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		{{-- <a class="btn btn-primary"  href="{{ route('accounts.upgrade',['account_id'=>'1003','service_id'=>'1003']) }}" class="btn btn-lg btn-light">Upgrade</a> --}}
		<a class="btn btn-primary"  href="{{ route('accounts.upgrade',['service_id'=>$code]) }}" class="btn btn-lg btn-light">Upgrade</a>
		</div>
	</div>
	</div>
</div>