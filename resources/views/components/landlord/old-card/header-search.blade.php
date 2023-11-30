{{-- bg-light-secondary /  bg-white --}}
<!-- card-header -->
<div class="card-header  bg-white">
    <div class="d-flex justify-content-between">
        <div class="align-self-center">
            <span class="card-title card-header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2196f3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <strong>{{ $title }} </strong>
            </span>
        </div>
        <div class="align-self-center">
            {{-- <x-widget-search :href="route('templates.index')"/> --}}
            <!-- ================ SEARCH ================================   -->
            <div class="mx-auto pull-right">
                <div class="">

                    <form action="{{ route( $route.'.index') }}" method="GET" role="search">

                        <div class="input-group">
                            
                            <input type="text" class="form-control form-control-sm mr-2" name="term" placeholder="Search..." id="term">
                            <span class="input-group-btn mr-5">
                                <button class="btn btn-secondary" type="submit" title="Search...">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </button>
                            </span>
                            <a href="{{ route( $route.'.index') }}" class="">
                                <span class="input-group-btn">
                                    <button class="btn btn-outline-secondary" type="button" title="Refresh">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                    </button>
                                </span>
                            </a>
                            @if ($export)
                                <a href="{{ route( $route.'.export') }}" class="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" title="Export">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                        </button>
                                    </span>
                                </a>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
            <!-- ================================================   -->

        </div>
    </div>
</div>
<!-- /.card-header -->