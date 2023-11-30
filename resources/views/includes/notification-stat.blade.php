<div class="row">
    <div class="col-md-6 col-xxl-3 d-flex">
        <div class="card illustration flex-fill">
            <div class="card-body p-0 d-flex flex-fill">
                <div class="row g-0 w-100">
                    <div class="col-6">
                        <div class="illustration-text p-3 m-1">
                            <h4 class="illustration-text">Welcome Back, {{ auth()->user()->name }}!</h4>
                            <p class="mb-0">Notification Listing</p>
                        </div>
                    </div>
                    <div class="col-6 align-self-end text-end">
                        <img src="{{asset('img/illustrations/customer-support.png')}}" width="100px" height="100px" alt="Social" class="img-fluid illustration-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xxl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Unread Notifications</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <i class="align-middle" data-feather="activity"></i>
                        </div>
                    </div>
                </div>
                @php
                    use App\Models\Item;
                    $count_unread   = auth()->user()->unreadNotifications->count();
                    $count_total    = auth()->user()->Notifications->count();
                    $count_read   = auth()->user()->readNotifications->count();
                    //$count_draft        = Pr::where('auth_status',AuthStatusEnum::DRAFT->value )->count();
                @endphp
                <span class="h1 d-inline-block mt-1">{{ $count_unread }}</span>
               
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xxl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Notifications</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
                
                <span class="h1 d-inline-block mt-1">{{ $count_total }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Read Notifications</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1">{{ $count_read }}</span>
            </div>
        </div>
    </div>
   
</div>
