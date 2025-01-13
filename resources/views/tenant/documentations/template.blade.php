@extends('layouts.tenant.doc')
@section('title','Documentations')

@section('breadcrumb')
	<li class="breadcrumb-item active">Template</li>
@endsection

@section('content')

			<h1 class="h3">Documentation</h1>

			<hr class="my-4">
			<div id="introduction" class="mb-5">
				<h3>Introduction</h3>
				<p class="text-lg">
					Hello, I hope you find this template useful. AppStack has been crafted on top of <strong>Bootstrap 5</strong> and uses modern web technologies such as <strong>HTML5</strong>,
					<strong>CSS3</strong> and <strong>jQuery</strong>. The included docs don't replace the official ones, but provide a clear view of all extended styles and
					new components that this template provides on top of Bootstrap 5.
				</p>

				<p class="">
					<a href="{{ asset('img/screenshots/theme-default.jpg') }}">
						<img src="{{ asset('img/screenshots/theme-default.jpg') }}" class="img-fluid rounded-3 landing-img" alt="Bootstrap 5 Dashboard Theme">
					</a>
				</p>

                <img src="{{ Storage::disk('s3lf')->url('screenshots/theme-default.jpg') }}" class="img-fluid rounded-3 landing-img" alt="Bootstrap 5 Dashboard Theme">
                <img src="{{ Storage::disk('s3l')->url('logo/logot.png') }}" class="rounded-circle img-responsive mt-2" width="128" height="128" alt="aaa" title="bb"/>

				{{-- <img src="{{ storage_path('/app/logo/xlogo.png') }}" width="90px" height="90px">
				<img src="{{ storage_path('app/logo/xlogo.png') }}" width="90px" height="90px"><br> --}}

				<p class="text-lg">
					The docs includes information to understand how the theme is organized, how to make changes to the source code, and how to compile and extend it to fit your needs.
				</p>
			</div>
			<div id="table-of-contents" class="mb-5">
				<h3>Table of Contents</h3>
				<ul class="text-lg">
					<li><a href="docs-installation.html">Getting started</a></li>
					<li><a href="docs-customization.html">Customization</a></li>
					<li><a href="docs-plugins.html">Plugins</a></li>
					<li><a href="docs-changelog.html">Changelog</a></li>
				</ul>
			</div>
			<div id="something-missing" class="mb-5">
				<h3>Something missing?</h3>
				<p class="text-lg">
					If something is missing in the documentation or if you found some part confusing, please send us an email (<a href="mailto:support@bootlab.io">support@bootlab.io</a>)
					with your suggestions for improvement. We love hearing from you!</p>
			</div>

			<div id="drop-jquery" class="mb-5">
				<h3>Drop jQuery</h3>
				<p class="text-lg">If you want to remove jQuery and all related plugins from your application, please follow these steps:</p>

				<ol>
					<li>Remove all jQuery modules from the JavaScript entry file: <code class="text-lg">/src/js/app.js</code></li>
					<li>Remove the snippets below from the <code class="text-lg">/webpack.config.js</code> file</li>
					<li>Run <code class="text-lg">npm run build</code></li>
				</ol>

			</div>

			<div class="alert alert-primary mb-5" role="alert">
				<div class="alert-message">
					<strong>Note:</strong> If you're not looking for any customizations or are not comfortable with Node.js or Webpack, you could use the pre-compiled (ready-to-use)
					files available in the dist folder. In that case, you can skip the set-up below.
				</div>
			</div>

@endsection

