@extends('landlord.layouts.site-app')
@section('title','User')
@section('breadcrumb','Create User')

@section('content')

    <x-landlord.card.header title="Create User"/>

    {{-- <div class="p-4 border-bottom">
        <h4 class="title mb-0">Create User</h4>
    </div> --}}

    <!-- form start -->
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- my-section-row -->
        <div class="row my-section-row justify-content-between">
            <div class="col-xl-6">
                <h6>Login Info:-</h6>
                
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-sm" 
                            name="email" id="email" placeholder="name@company.com" 
                            value="{{ old('email', "name@company.com" ) }}"     
                            class="@error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="maintenance" class="col-sm-3 col-form-label col-form-label-sm">Admin?</label>
                    <div class="col-sm-9">
                        <input class="form-check-input me-3" type="checkbox" id="form-check-default" name="maintenance">
                        <label class="" for="form-check-default">
                            Make this person an Admin
                        </label>
                        @error('maintenance')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>    
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" 
                            name="password" id="password" placeholder="password" 
                            value="{{ old('password', "" ) }}"     
                            autocomplete="current-password"
                            class="@error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label col-form-label-sm">Re- Password:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" 
                            name="password_confirmation" id="password" placeholder="Retype password" 
                            value="{{ old('password', "" ) }}"     
                            autocomplete="current-password"
                            class="@error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
            </div>

            <div class="col-xl-6">
                <h6>User Info:-</h6>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="name" id="name" placeholder="Full Name" 
                            value="{{ old('name', "Full Name" ) }}"     
                            class="@error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cell" class="col-sm-3 col-form-label col-form-label-sm">Cell</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="cell" id="cell" placeholder="01911-" 
                            value="{{ old('cell', "01911-" ) }}"     
                            class="@error('cell') is-invalid @enderror" required>
                        @error('cell')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                
                
            </div>
        </div>
        <!-- /.my-section-row -->

        <!-- my-section-row -->
        <div class="row my-section-row justify-content-between">
            <div class="col-xl-6">
                <h6>Address:-</h6>
                


                <div class="form-group row">
                    <label for="address1" class="col-sm-3 col-form-label col-form-label-sm">Address1</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="address1" id="address1" placeholder="XYZ Street" 
                            value="{{ old('address1', "XYZ Street" ) }}"     
                            class="@error('address1') is-invalid @enderror">
                        @error('address1')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address2" class="col-sm-3 col-form-label col-form-label-sm">Address2</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="address2" id="address2" placeholder="Road #8, Block C" 
                            value="{{ old('address2', "Road #8, Block C" ) }}"     
                            class="@error('address2') is-invalid @enderror">
                        @error('address2')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="zip" class="col-sm-3 col-form-label col-form-label-sm">Zip</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="zip" id="zip" placeholder="1229" 
                            value="{{ old('zip', "1229" ) }}"     
                            class="@error('zip') is-invalid @enderror">
                        @error('zip')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country" class="col-sm-3 col-form-label col-form-label-sm">Country</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="country" id="country" placeholder="bd" 
                            value="{{ old('country', "bd" ) }}"     
                            class="@error('country') is-invalid @enderror">
                        @error('country')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="col-xl-6">
                <h6>Social:-</h6>
                <div class="form-group row">
                    <label for="facebook" class="col-sm-3 col-form-label col-form-label-sm">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="facebook" id="facebook" placeholder="Facebook" 
                            value="{{ old('facebook', "https://www.facebook.com/username" ) }}"     
                            class="@error('facebook') is-invalid @enderror">
                        @error('facebook')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="linkedin" class="col-sm-3 col-form-label col-form-label-sm">LinkedIn</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" 
                            name="linkedin" id="linkedin" placeholder="LinkedIn" 
                            value="{{ old('linkedin', "https://www.linkedin.com/username" ) }}"     
                            class="@error('linkedin') is-invalid @enderror">
                        @error('linkedin')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.my-section-row -->
                
        <div class="my-section-buttons">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-dark" href="{{ route('users.index') }}">Cancel</a>
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>

    </form>
    <!-- /.form end -->

@endsection


@section('sidebar')
    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sidebar"> User List</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sidebar">User List</a>
    <a href="{{ route('users.export') }}" class="btn btn-success btn-sidebar">Download</a>
    <a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Home</a>
@endsection
