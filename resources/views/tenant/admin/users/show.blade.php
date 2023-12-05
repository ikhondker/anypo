@extends('layouts.app')
@section('title','Users')

@section('content')

    <x-page-header>
        @slot('title')
            Users
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="User"/>
            <x-buttons.header.create object="User"/>
            <x-buttons.header.edit object="User" :id="$user->id"/>
            <x-buttons.header.password :id="$user->id"/>
        @endslot
    </x-page-header>


    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $user->name }}"/>
                    <x-show.my-email    value="{{ $user->email }}"/>
                    <x-show.my-text     value="{{ $user->cell }}" label="Cell"/>
                    <x-show.my-text     value="{{ $user->designation_name->name }}" label="Title"/>
                    <x-show.my-text     value="{{ $user->dept_name->name }}" label="Dept"/>
                    <x-show.my-badge    value="{{ $user->role }}" label="Role"/>
                    <x-show.my-boolean  value="{{ $user->enable }}"/>
                    <x-show.my-badge    value="{{ $user->id }}"/>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Avatar</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                           <span class="h6 text-secondary">Avatar:</span>
                        </div>
                        <div class="col-sm-9">
                            <x-show.avatar avatar="{{ $user->avatar }}"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Address</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text value="{{ $user->address1 }}" label="Address1"/>
                    <x-show.my-text value="{{ $user->address2 }}" label="Address2"/>
                    <x-show.my-text value="{{ $user->city.', '.$user->state.', '.$user->zip  }}" label="City"/>    
                    <x-show.my-text value="{{ $user->country_name->name }}" label="Country"/>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Other Details</h5>
                </div>
                <div class="card-body">
                    <x-show.my-date-time   value="{{ $user->email_verified_at }}" label="Verified"/>
                    <x-show.my-date-time   value="{{ $user->last_login_at }}" label="Last Login"/>
                    <x-show.my-text        value="{{ $user->last_login_ip }}" label="Last IP"/>
                    <x-show.my-url         value="{{ $user->facebook }}" label="Facebook"/>
                    <x-show.my-url         value="{{ $user->linkedin }}" label="LinkedIn"/>
                </div>
            </div>
            
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-6">
            
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

@endsection

