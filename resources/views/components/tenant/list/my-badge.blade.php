{{-- // TODO
@if ($user->role ==  UserRoleEnum::USER)
    <span class="badge bg-soft-primary">{{ $user->role }}</span>
@else
    <span class="badge bg-soft-danger">{{ $user->role }}</span>
@endif --}}
                            
<span class="badge bg-success">{{ $value }}</span>