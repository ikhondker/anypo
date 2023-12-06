@extends('layouts.app')
@section('title','View Pr')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            View Pr
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Pr"/>
            <x-tenant.buttons.header.create object="Pr"/>
            <x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
            <x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
        @endslot
    </x-tenant.page-header>
    
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pr Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $pr->id }}" label="PR#"/>
                    <x-tenant.show.my-text     value="{{ $pr->summary }}"/>
                    <x-tenant.show.my-number   value="{{ $pr->amount }}" label="Amount"/>
                    <x-tenant.show.my-text     value="{{ $pr->relSupplier->name }}" label="Supplier"/>
                    <x-tenant.show.my-date     value="{{$pr->pr_date }}"/>
                    <x-tenant.show.my-text     value="{{ $pr->notes }}" label="Notes"/>
                    <x-show.my-edit-link object="Pr" :id="$pr->id"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Supporting Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $pr->status }}" label="Status"/>
                    <x-tenant.show.my-text     value="{{ $pr->relRequestor->name }}" label="Requestor"/>
                    <x-tenant.show.my-text     value="{{ $pr->relDept->name }}" label="Dept"/>
                    <x-tenant.show.my-text     value="{{ $pr->relProject->name }}" label="Project"/>
                    <x-tenant.show.my-date-time value="{{$pr->auth_date }}" label="Auth Date"/>
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                            <span class="h6 text-secondary">Attachments:</span>
                        </div>
                        <div class="col-sm-9">
                            <x-tenant.attachment.all entity="PR" aid="{{ $pr->id }}"/>
                        </div>
                    </div>
                    <form action="{{ route('prs.add') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <x-tenant.attachment.create  /> --}}
                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" hidden>
                        {{-- <x-buttons.submit/> --}}

                        <input id="fileInput" type="file" style="display:none;" />
                        <input type="button" value="Choose Files!" onclick="document.getElementById('fileInput').click();" />

                        <input type="file" id="upload" name="upload" onchange="myFunction2()"/>
                        <a href="" onclick="document.getElementById('upload').click(); return false">[Upload1]</a>

                        <a href="javascript:myFunction('You clicked!')">[Upload2]</a>

                        <a href="#" onclick="myFunction2()">[Upload3]</a>
                        
                        <a href="#" onclick="myFunction('You clicked!')">[Upload4]</a>

                        <a href="javascript:myFunction('You clicked!')">[My link]</a>
                        {{-- <button type="submit" onClick="placeOrder(this.form)">Place Order</button> --}}
                        {{-- <a type="submit" onClick="placeOrder(this.form)">Place Order</a> --}}


                        <input type="file" id="file_to_upload" name="file_to_upload" onchange="myFunction2()"/>
                        <a href="" onclick="document.getElementById('file_to_upload').click(); return false">[file_to_upload]</a>

                    </form>
                <!-- /.form end -->

                    <x-show.my-edit-link object="Pr" :id="$pr->id"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->


    <!-- widget-pr-lines -->
    <x-tenant.widgets.pr-lines id="{{ $pr->id }}"/>
    <!-- /.widget-pr-lines -->

    <!-- Approval History -->
    @if ($pr->wf_id <> 0)
        <x-tenant.widgets.approval-history id="{{ $pr->wf_id }}"/>
    @endif
    

    <!-- approval form, show only if pending to current auth user -->
    {{-- @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
    @include('tenant.includes.wfd-approve-reject')
    @endif  --}}

    <script type="text/javascript">
        function myFunction(myMessage) {
            alert(myMessage);
            document.getElementById('upload').click();
            document.getElementById('frm1').submit();
        }
        function myFunction2() {
            //alert('I am inside 2');
            //document.getElementById('upload').click();
            //xx();
            document.getElementById('frm1').submit();
        }

        async function xx() {
            alert('I am inside xx');
            document.getElementById('upload').click();
            //document.getElementById('frm1').submit();
        }

        function placeOrder(form){
            //document.getElementById('file_to_upload').click();
            document.getElementById('upload').click();
            form.submit();
        }

        </script>
        
@endsection

