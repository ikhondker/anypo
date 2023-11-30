<div class="card">
    <div class="card-header">
        <x-cards.header-with-simple-search object="Dept" :export="true"/>
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
                    <td>{{ $dept->id }}</td>
                    <td>{{ $dept->name }}</td>
                    <td><x-list.my-boolean :value="$dept->enable"/></td>
                    <td class="table-action">
                        <x-list.actions object="Dept" :id="$dept->id" :show="false"/>
                        {{-- <a type="button"  wire:click="enableId('11', 'Iqbal')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a> --}}
                        {{-- <a type="button" wire:click="enableId('111', 'Iqbal1')" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Primary</a> --}}
                        <a type="button" wire:click="enableId('111', 'Iqbal1')" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Primary</a>
                        {{-- <a href="{{ route('depts.destroy',$dept->id) }}" class="me-2 modal-boolean-advance" 
                            data-entity="Dept" data-name="{{ $dept->name }}" data-status="{{ ($dept->enable ? 'Disable' : 'Enable') }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($dept->enable ? 'Disable' : 'Enable') }}">
                            <i class="align-middle {{ ($dept->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($dept->enable ? 'bell-off' : 'bell') }}"></i>
                        </a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row pt-3">
            {{ $depts->links() }}
        </div>
        <!-- end pagination -->
       
       
        <a type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Primary</a>
        <a type="button" wire:click="addTodo('111', 'Iqbal1')" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Primary pass</a>
        {{-- <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Primary</button> --}}
        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Default modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body m-3">
                <p class="mb-0">Are you sure want to delete? </p>

                {{-- <p class="mb-0">Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content.</p> --}}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="change()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
              </div>
            </div>
          </div>
        </div>

    

    <!-- Modal -->
    <a type="button"  wire:click="addTodo('Iqbal3', 'a3@b.com')" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete btn</a>
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

        
    </div>
    <!-- end card-body -->

    

</div>
<!-- end card -->