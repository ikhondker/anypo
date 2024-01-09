@if ( $logo == '')
	<img src="{{asset('/logo/logo.png')}}" width="120px"> 
@else
	{{-- <img src="{{ route('setups.image', $logo ) }}" alt="" title="" width="90px">
	<img src="{{ route('logo', $logo ) }}" alt="" title="" width="90px"> --}}
	<img src="/logo/{{ $logo }}" alt="Logo" title="Logo" width="120px">
@endif