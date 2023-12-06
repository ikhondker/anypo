@extends('layouts.app')
@section('title','Budget')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Budget
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.create object="Budget"/>
            <a href="{{ route('notifications.all') }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-message"></i> Open Next Year Budget*</a>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    <x-cards.header-with-simple-search object="Budget" :export="true"/>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Start-End</th>
                                <th>End</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">PR(Booked)</th>
                                <th class="text-end">PR(Issued)</th>
                                <th class="text-end">Remaining PR</th>
                                <th class="text-end">PO(Booked)</th>
                                <th class="text-end">PO(Issued)</th>
                                <th class="text-end">Remaining PO</th>
                                <th>Enable</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($budgets as $budget)
                            <tr>
                                <td>{{ $budget->id }}</td>
                                <td>{{ $budget->name }}</td>
                                <td><x-list.my-date :value="$budget->start_date"/></td>
                                <td><x-list.my-date :value="$budget->end_date"/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->amount"/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->pr_booked_amount"/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->pr_issued_amount"/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->amount - $budget->pr_booked_amount - $budget->pr_issued_amount "/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->po_booked_amount"/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->po_issued_amount"/></td>
                                <td class="text-end"><x-tenant.list.my-number :value="$budget->amount - $budget->po_booked_amount - $budget->po_issued_amount "/></td>
                                <td><x-tenant.list.my-boolean :value="$budget->enable"/></td>
                                <td class="table-action">
                                    <x-tenant.list.actions object="Budget" :id="$budget->id" :show="true"/>
                                    <a href="{{ route('budgets.destroy',$budget->id) }}" class="me-2 modal-boolean-advance" 
                                        data-entity="Budget" data-name="{{ $budget->name }}" data-status="{{ ($budget->enable ? 'Disable' : 'Enable') }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($budget->enable ? 'Disable' : 'Enable') }}">
                                        <i class="align-middle {{ ($budget->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($budget->enable ? 'bell-off' : 'bell') }}"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        {{ $budgets->links() }}
                    </div>
                    <!-- end pagination -->
                    
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

     @include('tenant.includes.modal-boolean-advance')    

@endsection

