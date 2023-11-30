{{-- @extends('layouts.error-full-page')
@extends('layouts.site')
@section('title','Missing Associated Account!')
@section('heading','Missing Associated Account!')
@section('line1','However, system could not find any associated account with your user account.')
@section('lin22','Please contact support at support@HawarIT.com')
 --}}

@extends('layouts.landlord')
@section('title','Missing Associated Account!')

@section('content')

    <div class="container content-space-2">
        <div class="w-lg-50 mx-lg-auto">
            <!-- Card -->
            <div class="card card-lg mb-5">
                <div class="card-body">
                    <!-- Heading -->
                    <div class="text-center mb-5 mb-md-7">
                        <h1 class="h2 text-danger">Missing Associated Account!</h1>
                        
                        <p>&nbsp;</p>

                        <p class="card-text">However, system could not find any associated account with your user account.</p>
                        <p class="card-text">Please contact support at support@HawarIT.com</p>
                        <a href="{{ route('welcome') }}" class="btn btn-primary">Go to Home</a>
                    </div>
                    <!-- End Heading -->
            </div>
            </div>
            <!-- End Card -->
        </div>
    </div>

@endsection
