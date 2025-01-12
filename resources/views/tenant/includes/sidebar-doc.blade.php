<ul class="sidebar-nav">

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.index' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.index') }}">
			<i class="align-middle" data-lucide="home"></i><span class="align-middle">Home</span>
		</a>
	</li>

    @if (auth()->user()->isSystem())
        <li class="sidebar-item {{ (Route::currentRouteName() == 'docs.template' ? 'active' : '') }}">
            <a class="sidebar-link" href="{{ route('docs.template') }}">
                <i class="align-middle" data-lucide="settings"></i><span class="align-middle">Template</span>
            </a>
        </li>
	@endif

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.start' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.start') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Getting Started*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.faq' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.faq') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">FAQ*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.pr' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.pr') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Requisition*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.po' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.po') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Purchase Order*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.receipt' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.receipt') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Receipt*</span>
		</a>
	</li>


	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.invoice' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.invoice') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Invoice*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.payment' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.payment') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Payment*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.budget' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.budget') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Budget*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.dept-budget' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.dept-budget') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Dept Budget*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.master' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.master') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Master Data*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.user' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.user') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">User Management*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.hierarchy' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.hierarchy') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Hierarchy*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.approval' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.approval') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Approval*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.workflow' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.workflow') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Workflow*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.interface' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.interface') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Interface*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.currency' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.currency') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Currency*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.accounting' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.accounting') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Accounting*</span>
		</a>
	</li>

	<li class="sidebar-item {{ (Route::currentRouteName() == 'docs.setup' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.setup') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Setup*</span>
		</a>
	</li>

	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('home') }}">
			<i class="align-middle" data-lucide="undo-2"></i><span class="align-middle">Back to Portal</span>
		</a>
	</li>


	{{-- <li class="sidebar-item {{ (Route::currentRouteName() == 'docs.start' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('docs.start') }}">
			<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Support*</span>
		</a>
	</li> --}}

	{{-- <div class="sidebar-cta">
		<div class="sidebar-cta-content">
			<strong class="d-inline-block mb-2">Demo Site</strong>
			<div class="mb-3 text-sm">
				This is the demo instance of {{ env('APP_NAME') }} to showcase its features, functionality and design. {{ env('APP_URL') }}
			</div>
			<div class="d-grid">
				<a href="{{ env('APP_URL') }}/pricing" class="btn btn-primary" target="_blank"><i data-lucide="shopping-cart" class="align-middle"></i> Purchase</a>
			</div>
		</div>
	</div> --}}


</ul>
