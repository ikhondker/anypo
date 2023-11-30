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
                    <td>{{ $dept->id }}
                    </td>
                    <td>{{ $dept->name }}</td>
                    <td><x-list.my-boolean :value="$dept->enable"/></td>
                    <td class="table-action">

                            <a href="{{ 'depts.show',$dept->id }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Show">
                                <x-icons.show />
                            </a>
                            <a href="{{ 'depts.edit',$dept->id }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <x-icons.edit />
                            </a>

                            <a wire:click="deleteId( {{ $dept->id }})" class="me-2" data-bs-toggle="modal" data-bs-target="#enableModal" title="Enable11">
                                <x-icons.enable :enable="$dept->enable"/>
                            </a>

                            <span data-bs-toggle="modal" data-bs-target="#enableModal">
                                <a wire:click="deleteId( {{ $dept->id }})" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Enable">
                                    <x-icons.enable :enable="$dept->enable"/>
                                </a>
                            </span>

                        @can('delete', $dept)
                            <a wire:click="deleteId( {{ $dept->id }})" class="me-2" data-bs-toggle="modal" data-bs-target="#enableModal">
                                <x-icons.enable :enable="$dept->enable"/>
                            </a>
                        @else
                            <a class="me-2" data-bs-toggle="modal" data-bs-target="#infoModal">
                                <x-icons.enable :enable="$dept->enable"/>
                            </a>
                        @endcan

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
                    <h5 class="modal-title">Delete Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Are you sure you want to {{$deptStatus}}  Dept  '{{ $deptName }}'?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-primary" data-bs-dismiss="modal">Yes, Do it</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end enableModal -->

    <!-- start infoModal -->
    <div wire:ignore.self class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Action Forbidden</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Oppss!!!! We are sorry, but this action is not allowed by current user!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
    
            </div>
        </div>
    </div>
    <!-- end infoModal -->

</div>
<!-- end card -->

