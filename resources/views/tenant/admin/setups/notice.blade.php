@extends('layouts.app')
@section('title',' General Notice')
@section('breadcrumb',' General Notice')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            General Notice/Message
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.save/>
        @endslot
    </x-tenant.page-header>

    <!-- form start -->
    <form action="{{ route('setups.updatenotice',$setup->id) }}" method="POST">
        @csrf
        

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Currency Setup </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                               
                                <div class="alert alert-warning alert-outline" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message text-warning">
                                        <strong class="text-warning">WARNING!</strong> Once enabled, this message will be displayed to every user after login, in their dashboard!
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notice Text:</label>
                                <textarea class="form-control" name="notice"  placeholder="Enter Notice ..." rows="3">{{ old('notes', $setup->notice) }}</textarea>
                                @error('notice')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-check m-0">
                                <input type="checkbox" class="form-check-input"
                                    name="show_notice" id="show_notice"  @checked($setup->show_notice)/>
                                <span class="form-check-label text-danger">Show Notice?</span>
                                </label>
                            </div>

                            <x-tenant.widgets.submit/>
                        </div>
                    </div>
                    
                </div>
                <div class="col-6">
                </div>
            </div>

            <!-- end row -->
    </form>
    <!-- /.form end -->
@endsection

