@extends('layouts.app')
@section('title','Models List')
@section('breadcrumb')
    DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


    @section('content')
    <x-tenant.page-header>
        @slot('title')
            Model Lists
        @endslot
        @slot('buttons')
            <x-tenant.table-links/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title"> Model Lists</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="">Name</th>
                                <th class="">object</th>
                                <th class="">Route</th>
                                <th class="">Days Ago</th>
                                <th class="">Days</th>
                                <th class="">Jump</th>
                            </tr>
                        </thead>
            
                        <tbody>
                            
                            @foreach($filesInFolder as $path) 
                                @php
                                    $file = pathinfo($path);
                                    $f= $file['filename'] ;
                                    //$t= $file['mTime'];
                                    $last_modified=File::lastModified($path);
                                    //$t = $t1->toDateTimeString();
                                    //$t=gmdate("Y-m-d\TH:i:s\Z", $t1)->diffForHumans();
                                    // ok
                                    //$t = Carbon::createFromTimestamp($t1)->format('m/d/Y');
                                    $last_modified_human= \Carbon\Carbon::parse($last_modified)->diffForHumans();
                                    $last_modified_date= \Carbon\Carbon::parse($last_modified);
                                    $days = $last_modified_date->diffInDays(now(), false);
            
                                    $removed = Str::remove('Controller', $f);
                                    $route = Str::lower(Str::plural(Str::snake($removed, '-')));
                                @endphp
                                
            
                                    <tr>
                                        <td class=""> {{ ++$i }}</td>
                                        <td class="">{{ $f }}</td>
                                        <td class="">{{ Str::lower($f) }}</td>
                                        <td class="">{{ $route }}</td>
                                        <td class="text-start">
                                            @if ($days < 7)
                                            <span class="text-danger">  {{ $last_modified_human }} <span>
                                            @else
                                            {{ $last_modified_human }}
                                            @endif
                                        </td>
                                        <td class="text-start">{{ $days }}</td>
                                        <td class="table-action"><a class="text-info" href="http://localhost:8000/{{ $route }}">Jump</a></td>
                                    </tr>
                                    
                             
                                @endforeach
                        </tbody>
            
                    </table>
                </div>
            </div>
        </div>
    </div>
    

@endsection

