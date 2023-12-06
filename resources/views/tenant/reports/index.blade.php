@extends('layouts.app')
@section('title','Reports')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Reports
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.create object="Reports"/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-8">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Reports Lists</h5>
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
                            <tr>
                                <td>1</td>
                                <td>html</td>
                                <td>run</td>
                                <td class="table-action">
                                    <a class="btn btn-primary text-white" href="{{ route('reports.createPDF') }}">Create PDF</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>html</td>
                                <td>run</td>
                                <td class="table-action">
                                    <a class="btn btn-primary text-white" href="{{ route('reports.templatepr') }}">Template PR</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>html</td>
                                <td>run</td>
                                <td class="table-action">
                                    <a class="btn btn-primary text-white" href="{{ route('reports.templatepo') }}">Template PO</a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>html</td>
                                <td>run</td>
                                <td class="table-action">
                                    <a class="btn btn-primary text-white" href="{{ route('reports.stocks') }}">Onhand Stock </a>
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        aa
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

@endsection

