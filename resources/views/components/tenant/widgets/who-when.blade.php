@if ( auth()->user()->isSeeded())
    <div class="card">
        <div class="card-header">
            <div class="card-actions float-end">
                {{-- <a class="btn btn-sm btn-light" href="{{ route('depts.edit', $dept->id ) }}"><i class="fas fa-edit"></i> Edit</a> --}}
                {{-- <a class="btn btn-sm btn-light" href="{{ route('depts.index') }}" ><i class="fas fa-list"></i> View all</a> --}}
            </div>
            <h5 class="card-title">Standard Who and When</h5>
            <h6 class="card-subtitle text-muted">Standard Who and When Columns.</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm my-2">
                <tbody>
                    <tr>
                        <th>Created By :</th>
                        <td>{{ $createdBy }}</td>
                    </tr>
                    <tr>
                        <th>Created At :</th>
                        <td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($createdAt)))  }}</td>
                    </tr>
                    <tr>
                        <th>Updated By :</th>
                        <td>{{ $updatedBy }}</td>
                    </tr>
                    <tr>
                        <th>Updated At :</th>
                        <td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($updatedAt)))  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif
