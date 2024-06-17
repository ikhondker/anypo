@extends('layouts.landlord.app')
@section('title', 'Unhandled Error Logs')
@section('breadcrumb', 'Unhandled Error Logs')

@section('content')

    <a href="{{ route('error-logs.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Error Log</a>
    <h1 class="h3 mb-3">All Error Logs</h1>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 col-xl-4 mb-2 mb-md-0">
                    <!-- form -->
                    <form action="{{ route('error-logs.index') }}" method="GET" role="search">
                        <div class="input-group input-group-search">
                            <input type="text" class="form-control" id="datatables-errorLog-search"
                                minlength=3 name="term"
                                value="{{ old('term', request('term')) }}" id="term"
                                placeholder="Search errors…" required>
                            <button class="btn" type="submit">
                                <i class="align-middle" data-lucide="search"></i>
                            </button>
                        </div>
                        @if (request('term'))
                            Search result for: <strong class="text-danger">{{ request('term') }}</strong>
                        @endif
                    </form>
                    <!--/. form -->
                </div>
                <div class="col-md-6 col-xl-8">
                    <div class="text-sm-end">
                        <a href="{{ route('error-logs.index') }}" class="btn btn-primary btn-lg"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
                            <i data-lucide="refresh-cw"></i></a>
                        {{-- <a href="{{ route('errorLogs.export') }}" class="btn btn-light btn-lg me-2"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
                            <i data-lucide="download"></i> Export</a> --}}
                    </div>
                </div>
            </div>

            <table id="datatables-orders" class="table w-100">
                <thead>
                    <tr>

                    <th class="align-middle">#</th>
                        <th class="align-middle">Tenant</th>
                        <th class="align-middle">URL</th>
                        <th class="align-middle">Type</th>
                        <th class="align-middle">Date</th>
                        <th class="align-middle">User</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($errorLogs as $errorLog)
                        <tr>
                            <td>
                                <img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
                            </td>
                            <td>
                                <a href="{{ route('error-logs.show', $errorLog->id) }}">
                                    <strong>{{ $errorLog->tenant }}</strong>
                                </a>
                            </td>
                            <td>{{ $errorLog->url }}</td>
                            <td>{{ $errorLog->e_class }}</td>
                            <td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($errorLog->created_at))) }}</td>
                            <td>{{ $errorLog->user_id }}</td>
                            <td><x-landlord.list.my-badge :value="$errorLog->status" /></td>
                            <td class="text-end">
                                <a href="{{ route('error-logs.show',$errorLog->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="View">View</a>
                                    <a href="{{ route('error-logs.edit',$errorLog->id) }}" class="text-body" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="View"> <i data-lucide="edit"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row mb-3">
                {{ $errorLogs->links() }}
            </div>

        </div>
    </div>


@endsection
