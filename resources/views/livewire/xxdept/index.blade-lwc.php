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
                        <x-list.actions object="Dept" :id="$dept->id" :show="false"/>                     
                        <a wire:ignore wire:click="deleteId( {{ $dept->id }},'{{ $dept->name }}','{{ $dept->enable }}' )" class="me-2" data-bs-toggle="modal" data-bs-target="#enableModal">
                            <i class="align-middle {{ ($dept->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($dept->enable ? 'bell-off' : 'bell') }}"></i>
                        </a>
                        <a wire:click="deleteId( {{ $dept->id }})" class="me-2" data-bs-toggle="modal" data-bs-target="#enableModal">
                            @if ($dept->enable)
                                <x-icons.bell-off/>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell-off"><path d="M13.73 21a2 2 0 0 1-3.46 0"></path><path d="M18.63 13A17.89 17.89 0 0 1 18 8"></path><path d="M6.26 6.26A5.86 5.86 0 0 0 6 8c0 7-3 9-3 9h14"></path><path d="M18 8a6 6 0 0 0-9.33-5"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg> --}}
                            @else
                                <x-icons.bell/>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg> --}}
                            @endif
                        </a>
                     
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
       
        <a type="button" wire:click="deleteId('999')" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#enableModal">Enable 999</a>
        
    </div>
    <!-- end card-body -->

    
    <div wire:ignore.self class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Are you sure want to delete? {{ $deleteId }} {{ $deptName }} {{$deptStatus}} </p>
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
<!-- end card -->

