@extends('layouts.app')
@section('title','403 | Page Forbidden.')

@section('content')

    <div class="row">
        <div class="col-8">
            <div class="card p-6">
                <div class="card-header">
                </div>
                <div class="card-body">
                    
                    <div class="row h-100">
						<div class="col-sm-10 col-md-8 col-lg-8 mx-auto d-table h-100">
							<div class="d-table-cell align-middle">
								<div class="text-center">
									<h2 class="display-2 fw-bold text-warning">Oppss!!!!</h2>
									<p class="h1 text-muted">Page Forbidden.</p>
									<p class="h2 fw-normal mt-3 mb-4">We are sorry, but this action is not allowed by current user.</p>
									<a href="{{ URL::previous() }}" class="btn btn-primary btn-lg">Back</a>
								</div>
							</div>
						</div>
					</div>
                    
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

@endsection


