
{{-- <img class="navbar-brand-logo" src="{{ asset('/assets/svg/logos/logo.svg') }}" alt="Logo"> --}}
@if ( $logo == '')
	<img src="{{asset('/assets/logo/logo.png')}}" width="120px"> 
@else
	{{-- <img src="{{ route('logo.image', $logo ) }}" alt="" title="" width="90px"> --}}
	{{-- <img src="{{ route('logo', $logo ) }}" alt="" title="" width="90px"> --}}
	<img src="/logo/{{ $logo }}" alt="Logo2" title="Logo1" width="120px">
@endif

<img src="{{ storage_path('app/logo/1001.png') }}" alt="Logo2" title="Logo1" width="120px">
<img src="{{ url('storage/app/logo/1001.png') }}" alt="" title="" />


