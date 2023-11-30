@extends('layouts.app')

@section('title','Modal | anyPO.com')
@section('content-header')
    <!-- Null -->
@endsection

@section('content')

      <x-page-header>
          @slot('title')
              Modal Window
          @endslot
          @slot('buttons')
              <a href="#" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> Home</a>
              <a href="#" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> New project</a>
          @endslot
      </x-page-header>

        <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Empty card Test</h5>
            </div>
            <div class="card-body">
             

              <form method="POST" action="{{ route('countries.destroy', 'BD') }}">
                  @csrf

                  <div class="row">
                      <div class="col-6">
                          Bootstrap
                      </div>
                      <div class="col-6">
                          bs5.blade.php
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                        Appstack
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary1">Primary</button>
                        <div class="modal fade" id="defaultModalPrimary1" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Default modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body m-3">
                                <p class="mb-0">Are you sure want to delete?</p>
                              </div>
                              <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                                <button type="button" wire:click.prevent="do()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button> --}}
        
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" wire:click.prevent="do()" class="btn btn-danger" data-dismiss="modal">Yes, Delete</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    hello world
                  </div>
                  <div class="col-6">
                    @livewire('hello-world')
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    lw-button
                  </div>
                  <div class="col-6">
                    @livewire('lw-button')
                  </div>
                </div>

              </form>
              
            </div>
          </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@endsection




