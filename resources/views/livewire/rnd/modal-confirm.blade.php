<div>
	{{-- <button wire:click="addTodo('Iqbal3', 'a3@b.com')" type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Appstack</button> --}}
	<button type="button" wire:click="deleteId('4123')" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Appstack</button>

	<div wire:ignore.self class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title">Delete Confirm</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">
					<p class="mb-0">Are you sure want to delete? {{ $deleteId }}</p>
				</div>
				<div class="modal-footer">
					{{-- <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
					<button type="button" wire:click.prevent="do()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button> --}}

					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					{{-- <button type="button" wire:click.prevent="delelte()" class="btn btn-danger" data-dismiss="modal">Yes, Delete</button> --}}
					<button type="button" wire:click.prevent="delete()" class="btn btn-primary" data-bs-dismiss="modal">Save Changes</button>
				</div>

			</div>
		</div>
	</div>

</div>
