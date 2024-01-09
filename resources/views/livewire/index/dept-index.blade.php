<div class="card">
	<div class="card-header">
		<x-cards.header-with-simple-search object="Dept" title="Department" :export="true"/>
	</div>
	<div class="card-body">
	  
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Enable</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($depts as $dept)
				<tr>
					<td>{{ $dept->id }}
					</td>
					<td>{{ $dept->name }}</td>
					<td><x-list.my-boolean :value="$dept->enable"/></td>
					<td class="table-action">
						<a href="{{ route('depts.show',$dept->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Show"><x-icons.show/></a>
						<a href="{{ route('depts.edit',$dept->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><x-icons.edit/></a>
						<span data-bs-toggle="modal" data-bs-target="#enableModal">
							<a wire:click="setId( {{ $dept->id }})" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Enable">
								<x-icons.enable :enable="$dept->enable"/>
							</a>
						</span>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row pt-3">
			{{ $depts->links() }}
		</div>
		<!-- end pagination -->
	
	</div>
	<!-- end card-body -->

	<!-- start enableModal -->
	<div wire:ignore.self class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<x-icons.confirm/> 
						@can('delete', $dept)
							Confirmation
						@else
							Action Forbidden!
						@endcan
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">
					<p class="mb-0"> {{$message}}</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					@can('delete', $dept)
						<button type="button" wire:click.prevent="do()" class="btn btn-primary" data-bs-dismiss="modal">Yes, Do it</button>
					@endcan
				</div>
			</div>
		</div>
	</div>
	<!-- end enableModal -->

</div>
<!-- end card -->

