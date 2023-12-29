@extends('layouts.landlord-app')
@section('title','Users')
@section('breadcrumb','View Category')

@section('content')
    <!-- Card -->
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-header-title">User Category</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Category photo</label>

              <div class="col-sm-9">
                <!-- Media -->
                <div class="d-flex align-items-center">
                  <!-- Avatar -->
                  <label class="avatar avatar-xl avatar-circle" for="avatarUploader">
                    <img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Image Description">
                  </label>

                  <div class="d-grid d-sm-flex gap-2 ms-4">
                    <div class="form-attachment-btn btn btn-primary btn-sm">Upload photo
                      <input type="file" class="js-file-attach form-attachment-btn-label" id="avatarUploader"
                              data-hs-file-attach-options='{
                                "textTarget": "#avatarImg",
                                "mode": "image",
                                "targetAttr": "src",
                                "resetTarget": ".js-file-attach-reset-img",
                                "resetImg": "./assets/img/160x160/img1.jpg",
                                "allowTypes": [".png", ".jpeg", ".jpg"]
                              }'>
                    </div>
                    <!-- End Avatar -->
                  </div>
                </div>
                <!-- End Media -->
              </div>
            </div>
            <!-- End Form -->

            <x-landlord.show.my-text     value="{{ $category->name }}"/>
            <x-landlord.show.my-enable   value="{{ $category->enable }}"/>
          
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="card-footer pt-0">
            <div class="d-flex justify-content-end gap-3">
              <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
            </div>
        </div>
        <!-- End Footer -->
    </div>
    <!-- End Card -->
@endsection


