@extends('layouts.app')
@section('title','DeptBudget')

@section('content')

    <x-tenant.page-header>
        @slot('title')
        DeptBudget Revision
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.create object="DeptBudget"/>
            <x-tenant.buttons.header.lists object="DeptBudget"/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">DeptBudget Revision</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Budget Name</th>
                                <th>Budget Period</th>
                                <th>Dept</th>
                                <th>Revision Date</th>
                                <th>Revision By</th>
                                <th class="text-end">Amount</th>
                                <th>Revision?</th>
                                <th>Notes</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dept_budgets as $dept_budget)
                            <tr>
                                <td>{{ $dept_budget->id }}</td>
                                <td>{{ $dept_budget->budget->name }}</td>
                                <td><x-list.my-date :value="$dept_budget->budget->start_date"/> - <x-list.my-date :value="$dept_budget->budget->end_date"/></td>
                                <td>{{ $dept_budget->dept->name }}</td>
                                <td><x-tenant.list.my-date-time :value="$dept_budget->created_at"/></td> 
                                <td>{{ $dept_budget->user_created_by->name }}</td>     
                                <td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount"/></td>
                                <td><x-tenant.list.my-boolean :value="$dept_budget->revision"/></td>
                                <td>{{ $dept_budget->notes }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        {{ $dept_budgets->links() }}
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

