<div>
	<div class="row mt-5">
		<div class="col-md-6 offset-3">
			<div class="card">
				<div class="card-header bg-info text-white">
					<h5><strong>Laravel Livewire Bootstrap Modal Example - NiceSnippets.com</strong></h5>
				</div>
				<div class="card-body">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						Open Modal
					</button>
					<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										 <span aria-hidden="true close-btn">×</span>
									</button>
								</div>
								<div class="modal-body">
									Laravel Livewire Bootstrap Modal Example - NiceSnippets.com
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
									<button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>