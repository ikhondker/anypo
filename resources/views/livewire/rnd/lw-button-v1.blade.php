<div>
	{{-- <button wire:click="addTodo('111', '222')">
		Add Todo LW
	</button> --}}
	<form>
		<input type="text" class="form-control" wire:model="name" id="exampleFormControlInput1" placeholder="Enter Name">
		<input wire:model="message" type="text">
	</form>

	<h4>{{ $message }}</h4>
	<h4>{{ $name }}</h4>


	<button wire:click="addTodo('Iqbal3', 'a3@b.com')" type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Appstack 11</button>
	<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Default modal Appstack 11</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3">
			<p class="mb-0">Are you sure want to delete? 1</p>
			</div>
			<div class="modal-footer">
			{{-- <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
			<button type="button" wire:click.prevent="do()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button> --}}

			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="button" wire:click.prevent="do()" class="btn btn-danger" data-dismiss="modal">Yes, Delete 1</button>
			<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
		</div>
	</div>


	{{-- <button type="button" wire:click="addTodo('111', '222')" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button> --}}
	<button type="button"  wire:click="addTodo('Iqbal1', 'a@b.com')" class="btn btn-danger">check</button>
	<a type="button"  wire:click="addTodo('Iqbal3', 'a3@b.com')" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete btn1</a>
	{{-- <button type="button" wire:click="deleteId({{ $user->id }})" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button> --}}

	{{-- <a href="{{ route('design',999) }}" wire:click="addTodo('111', '222')" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Enable/Disable">
		<i class="align-middle" data-feather="bell-off"></i>
	</a> --}}

	<!-- Modal -->
	<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true close-btn">×</span>
					</button>
				</div>
			<div class="modal-body">
					<p>Are you sure want to delete? message={{ $message }} name={{ $this->name }} email={{ $this->email }}</p>
					{{-- <input type="text" class="form-control" wire:model="name" id="exampleFormControlInput1" placeholder="Enter Name"> --}}
					{{-- <input type="text" class="form-control" wire:model="email" id="exampleFormControlInput1" placeholder="Enter Name"> --}}

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
					<button type="button" wire:click.prevent="do()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
				</div>
			</div>
		</div>
	</div>

	{{--
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
					Laravel Livewire Bootstrap Modal Example - NiceSnippets.com 111 message={{ $message }} a={{ $a }} b={{ $b }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
					<button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>

					<button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
					<button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
				</div>
			</div>
		</div>
	</div> --}}


</div>