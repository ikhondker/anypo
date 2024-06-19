@extends('layouts.landlord.app')
@section('title','Edit Service')
@section('breadcrumb','Edit Service')

@section('content')

    <h1 class="h3 mb-3">Edit Service</h1>

    <div class="card">
        <div class="card-header">

            <h5 class="card-title">Edit Service (Admin Only)</h5>
            <h6 class="card-subtitle text-muted">Edit Service Details.</h6>
        </div>
        <div class="card-body">
            <form id="myform" action="{{ route('services.update',$service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <table class="table table-sm my-2">
                    <tbody>

                        <x-landlord.edit.id-read-only :value="$service->id"/>
                        <x-landlord.edit.name :value="$service->name"/>

                        <tr>
                            <th>Mnth :</th>
                            <td>
                                <input type="number" class="form-control @error('mnth') is-invalid @enderror"
                                name="mnth" id="mnth" placeholder="Name"
                                value="{{ old('mnth', $service->mnth ) }}"
                                required/>
                            @error('mnth')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Users :</th>
                            <td>
                                <input type="number" class="form-control @error('mnth') is-invalid @enderror"
                                        name="user" id="user" placeholder="Name"
                                        value="{{ old('user', $service->user ) }}"
                                        required/>
                                    @error('user')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror

                            </td>
                        </tr>
                        <tr>
                            <th>GB :</th>
                            <td>
                                <input type="number" class="form-control @error('gb') is-invalid @enderror"
                                        name="gb" id="gb" placeholder="Name"
                                        value="{{ old('gb', $service->gb ) }}"
                                        required/>
                                    @error('gb')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Price :</th>
                            <td>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price" id="price" placeholder="Name"
                                        value="{{ old('price', $service->price ) }}"
                                        required/>
                                    @error('price')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Start Date:</th>
                            <td>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        name="start_date" id="start_date" placeholder="Name"
                                        value="{{ old('start_date', $service->start_date ) }}"
                                        required/>
                                    @error('start_date')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>End Date :</th>
                            <td>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        name="end_date" id="end_date" placeholder="Name"
                                        value="{{ old('end_date', $service->end_date ) }}"
                                        required/>
                                    @error('end_date')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                            </td>
                        </tr>


                    </tbody>
                </table>

                <x-landlord.edit.save/>
            </form>
        </div>
    </div>

@endsection
