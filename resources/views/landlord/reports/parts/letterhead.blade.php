<header class="clearfix">
    <div id="logo">
        <img src="{{ storage_path('app/logo/logo.png') }}">
    </div>
    <div id="company">
        <h2 class="name">{{ env('APP_NAME')}}</h2>
        <div>{{ $setup->address1.', '. $setup->address2 }}</div>
        <div>{{ $setup->city.', '.$setup->state.', '.$setup->zip. ', '.$setup->country  }}</div>
        <div>{{ $setup->cell }}</div>	
        <div>{{ $setup->email }}</div>	
        {{-- <div>{{ $setup->website }}</div> --}}
        {{-- <div>(602) 519-0450</div>
        <div>company@example1.com</div> --}}
    </div>
    </div>
</header>