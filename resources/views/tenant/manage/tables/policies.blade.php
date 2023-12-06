@extends('layouts.app')
@section('title','Policies List')
@section('breadcrumb')
    DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
 
    <x-tenant.page-header>
        @slot('title')
            Routes Lists
        @endslot
        @slot('buttons')
            <x-tenant.table-links/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Policies Lists</h5>
                </div>
                <div class="card-body">
                            <h5>App\Provider\AuthServiceProvider.php</h5>
                            @foreach($filesInFolder as $path) 
                                    @php
                                        $file = pathinfo($path);
                                        $fname = $file['filename'];
                                        //'App\Models\Landlord\Account' => 'App\Policies\Landlord\AccountPolicy',
                                    @endphp
                                        {{-- 'App\Models\Landlord\{{ $fname }}' => 'App\Policies\Landlord\{{ $fname }}Policy',</br> --}}
                                        'App\Models\{{ $fname }}' => 'App\Policies\{{ $fname }}Policy',</br>
                            @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

