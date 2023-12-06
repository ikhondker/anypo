{{-- ================================================================== --}}
<div class="row">
    <div class="col-8 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Attachment</h5>
                <h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
            </div>
            
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th class="" scope="col">#</th>
                        <th class="" scope="col">Owner</th>
                        <th class="" scope="col">File Name</th>
                        <th class="" scope="col">Size</th>
                        <th class="" scope="col">Upload Date</th>
                        <th class="" scope="col">Download File</th>
                        <th class="" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attachments as $attachment)
                    <tr>
                        <td class=""> {{ $loop->iteration }}</td>
                        <td class=""> {{ $attachment->owner->name }}</td>
                        <td class=""> {{ $attachment->org_file_name }}</td>
                        <td class=""> {{ $attachment->file_size }}</td>
                        <td><x-tenant.list.my-date-time :value="$attachment->upload_date"/></td>
                        <td><x-tenant.attachment.single id="{{ $attachment->id }}"/></td>
                        <td class="table-action">
                            <a href="{{ route('attachments.destroy', $attachment->id) }}" class="me-2 modal-boolean-advance" 
                                data-entity="Attachment" data-name="{{ $attachment->org_file_name }}" data-status="Delete"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                <i class="align-middle text-muted" data-feather="trash-2"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>    
{{-- ============================================================== --}}

@include('tenant.includes.modal-boolean-advance')   