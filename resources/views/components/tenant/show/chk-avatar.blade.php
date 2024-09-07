@if ( $avatar == '')
	<img src="{{asset('/avatar/avatar.png')}}" width="120px"> 
@else
	{{-- <img src="{{ route('setups.image', $logo ) }}" alt="" title="" width="90px">
	<img src="{{ route('logo', $logo ) }}" alt="" title="" width="90px"> --}}
	<img src="/avatar/{{ $avatar }}" alt="Avatar" title="Avatar" width="120px">
@endif