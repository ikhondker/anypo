@extends('landlord.layouts.site-app')
@section('title','Test Page')
@section('breadcrumb','Templates v1.2 (31-JAN-23)')

@section('content')

        {{ config('app.name') }}


        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Your Name <x-landlord.red-star/></label>
                {{-- <input name="name" id="name" type="text" class="form-control" placeholder="Name :" required> --}}
                @auth
                <input type="text" class="form-control" 
                    name="name" id="name" placeholder="John Doe" 
                    value="{{ old('name', auth()->user()->name ) }}"     
                    class="@error('name') is-invalid @enderror" hidden>
                    @error('name')
                        <div class="text-danger text-xs">{{ $message }}</div>
                    @enderror
                    <p> {{ auth()->user()->name  }}</p>
                @endauth
                @guest
                    <input type="text" class="form-control form-control-sm" 
                        name="name" id="name" placeholder="John Doe" 
                        value="{{ old('name', "John Doe" ) }}"     
                        class="@error('name') is-invalid @enderror" required>
                        @error('name')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                @endguest
            </div>

        <div class="card bg-soft-muted">
            <h5 class="card-header"><i data-feather="edit" class="fea text-muted"></i>Featured</h5>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go to Home</a>
            </div>
        </div>

        <div class="card bg-soft-info">
            <h5 class="card-header"><i data-feather="alert-triangle" class="fea text-info"></i>  An Error Occured!</h5>
            <div class="card-body">
                <h5 class="card-title">Payment Canceled!</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">Please contact support at support@HawarIT.com</p>
                <a href="{{ route('welcome') }}" class="btn btn-primary">Go to Home</a>
            </div>
        </div>

        <a href="{{ route('home.checkout',['id'=>'1003']) }}" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Upgrade A</a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> <i data-feather="edit" class="fea text-muted"></i>Upgrade Service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title w-100">Are you sure?</h4>	
                    This will upgrade your package immidiately. However, You will be billed on revised rate form your next bill cycle. Do you want to proceed?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a class="btn btn-primary"  href="{{ route('accounts.upgrade',['account_id'=>'1003','service_id'=>'1003']) }}" class="btn btn-lg btn-light">Upgrade</a>
                </div>
            </div>
            </div>
        </div>
    
@endsection