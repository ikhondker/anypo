{{-- <img src="{{asset('img/avatars/avatar-5.jpg')}}" width="48" height="48" class="rounded-circle me-2" alt="Avatar">  --}}

@if ( $avatar == '')
    {{-- <img src="{{asset('img/avatar.png')}}" width="120px">  --}}
    <img src="{{asset('/avatar/avatar.png')}}" width="48" height="48" class="rounded-circle me-2" alt="Avatar"> 
@else
    {{-- <img src="{{ route('setups.image', $logo ) }}" alt="" title="" width="90px">
    <img src="{{ route('logo', $logo ) }}" alt="" title="" width="90px"> --}}
    <img src="/avatar/{{ $avatar }}" width="48" height="48" class="rounded-circle me-2" alt="Avatar">
@endif