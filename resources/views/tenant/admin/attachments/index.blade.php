@extends('layouts.app')
@section('title','Attachment')

@section('content')

    <x-page-header>
        @slot('title')
            Attachment
        @endslot
        @slot('buttons')
            <x-buttons.header.create object="Attachment"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    <x-cards.header-search-export-bar object="Attachment"/>
                    <h5 class="card-title">
                        @if (request('term'))
                            Search result for: <strong class="text-danger">{{ request('term') }}</strong>
                        @else
                            Attachments Lists
                        @endif
                    </h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Article ID</th>
                                <th>Entity</th>
                                <th>Date</th>
                                <th>Owner</th>
                                <th>File Name</th>
                                <th>View/Download</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attachments as $attachment)
                            <tr>
                                <td>{{ $attachment->id }}</td>
                                <td>{{ $attachment->article_id }}</td>
                                <td>{{ $attachment->entity }}</td>
                                <td><x-list.my-date-time :value="$attachment->upload_date"/></td>
                                <td>{{ $attachment->owner->name }}</td>
                                <td>{{ $attachment->org_file_name }}</td>
                                <td><x-attachment.single id="{{ $attachment->id }}"/></td>
                                <td class="table-action">
                                    <a href="{{ route('attachments.show',$attachment->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <i class="align-middle" data-feather="eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        {{ $attachments->links() }}
                    </div>
                    <!-- end pagination -->
                    
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

     @include('includes.modal-boolean-advance')    

@endsection

