@extends('layouts.app')
@section('title','Hierarchy')

@section('content')

    <x-page-header>
        @slot('title')
            Hierarchy
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Hierarchy"/>
            <x-buttons.header.create object="Hierarchy"/>
            <x-buttons.header.edit object="Hierarchy" :id="$hierarchy->id"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Hierarchy Name:  {{ $hierarchy->name }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Approver Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hierarchyls as $hierarchyl)
                            <tr>
                                <td><span class="badge bg-primary-light">{{ $hierarchyl->id }}</span></td>
                                <td>{{ $hierarchyl->approver->name }}</td>
                                <td>{{ $hierarchyl->approver->email }} </td>
                                <td>{{ $hierarchyl->approver->designation_name->name }} </td>
                                <td class="table-action">
                                    {{-- <a class="btn btn-info" href="{{ route('hierarchy_details.edit',$hierarchy_detail->id) }}">Edit (TBD)</a>
                                    <a class="btn btn-danger" href="{{ route('hierarchy_details.show',$hierarchy_detail->id) }}">Enable (TBD)</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
           
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

    

@endsection

