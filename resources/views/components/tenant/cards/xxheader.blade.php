<div class="card-header">
    <div class="card-actions float-end">
        <div class="btn-toolbar mb-4" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
                @if ($export)
                <a href="{{ route( $route.'.export') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                    <i class="fa-solid fa-download"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
    <h5 class="card-title">
        @if (request('term'))
            Search result for: <strong>{{ request('term') }}</strong>
        @else
            {{ $title }} List
        @endif
    </h5>
    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout x-cards.header.</h6>
</div>