    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">PR# {{ $pr->id }}</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-text     value="{{ $pr->summary }}"/>
                    <x-tenant.show.my-amount-currency   value="{{ $pr->amount }}" currency="{{ $pr->currency }}" />
                    <x-tenant.show.my-text     value="{{ $pr->relRequestor->name }}" label="Requestor"/>
                    <x-tenant.show.my-text     value="{{ $pr->relSupplier->name }}" label="Supplier"/>
                    <x-tenant.show.my-date     value="{{ $pr->pr_date }}"/>
                    <div class="row">
                        <div class="col-sm-3 text-end">
                            
                        </div>
                        <div class="col-sm-9 text-end">
                            <x-show.my-edit-link object="Pr" :id="$pr->id"/>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <div class="dropdown position-relative">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('prs.detach',$pr->id) }}">Delete Attachment</a>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title">Supporting Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $pr->auth_status }}" label="Auth Status"/>
                    <x-tenant.show.my-date-time value="{{$pr->auth_date }}" label="Auth Date"/>
                    <x-tenant.show.my-badge    value="{{ $pr->status }}" label="Status"/>
                    <x-tenant.show.my-text     value="{{ $pr->relDept->name }}" label="Dept"/>
                    <x-tenant.show.my-text     value="{{ $pr->relProject->name }}" label="Project"/>
                    <x-tenant.show.my-text     value="{{ $pr->notes }}" label="Notes"/>
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                            <span class="h6 text-secondary">Attachments:</span>
                        </div>
                        <div class="col-sm-9">
                            <x-tenant.attachment.all entity="PR" aid="{{ $pr->id }}"/>
                        </div>
                    </div>

                    <form action="{{ route('prs.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <x-tenant.attachment.create  /> --}}
                        <input type="text" name="attach_pr_id" id="attach_pr_id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" hidden>
                        <div class="row">
                            <div class="col-sm-3 text-end">
                            
                            </div>
                            <div class="col-sm-9 text-end">
                                <input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
                                <a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
                                {{-- <x-show.my-edit-link object="Pr" :id="$pr->id"/> --}}
                            </div>
                        </div>

                        {{-- <x-buttons.submit/> --}}
                    </form>
                    <!-- /.form end -->
                
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

    <script type="text/javascript">
        function mySubmit() {
            //alert('I am inside 2');
            //document.getElementById('upload').click();
            document.getElementById('frm1').submit();
        }
    </script>
