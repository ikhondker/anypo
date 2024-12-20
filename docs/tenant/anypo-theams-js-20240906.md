

# 4. Size
-------------------------------------------------------------------------------------------------
laptop screen size
1920 x 1080
1440 x 900
1280x1024
1024x768

logo color:

logo color:
blue: #008BCD
ash: #6A778A

# 3. Icons (Tenat & landlord)
====================================================================
- lucide and font awsome

Lanldord & Tenant
- sidebar - lucide
- page header button - <i class="fas fa-plus"></i>
- card header button - <i class="fas fa-edit"></i>
- pages(index)
- pages(show)
- buttons
- kpi 			<i class="align-middle" data-lucide="activity"></i>

# 2. Tenant and landlord Theme App: AppsStack 4.0.0
====================================================================
Now 4.0.1 avaiable

was in Asus Laptop
Version: appstack-4-0-0.zip
Source: E:\BoughtGraphics\AppStack
vanila: D:\xampp\htdocs\appstack4
scss change: D:\xampp\htdocs\appstack4
  -> D:\xampp\htdocs\appstack4\src\js\ app.js and custom.js  [Asus laptop]
	- place everything inside D:\laravel\anypo\public\tenancy\assets TODO
	- aws\anypo-public -> tenancy\assets TODO
	- aws filesystem s3t

sample: User

anypo_full_v.0.17 front discarded

small icon
<span data-feather="home" class="feather-sm me-1"></span>

-- icons
USED: Lucide
<i data-lucide="download"></i>

used==> https://fontawesome.com/v4/
light.css
* Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com
<i class="fa-regular fa-square-plus">
<i class="fa-regular fa-rectangle-list"></i>


// Theme colors
$blue: 			#3F80EA !default;
$indigo:	 	#6610f2 !default;
$purple: 		#6f42c1 !default;
$pink:		 	#e83e8c !default;
$red: 			#d9534f !default;
$orange: 		#fd7e14 !default;
$yellow: 		#E5A54B !default;
$green: 		#4BBF73 !default;
$teal: 			#20c997 !default;
$cyan: 			#1F9BCF !default;

$white: #fff !default;
$gray-100: #f4f7f9 !default;
$gray-200: #e2e8ee !default;
$gray-300: #dee6ed !default;
$gray-400: #ced4da !default;
$gray-500: #adb5bd !default;
$gray-600: #6c757d !default;
$gray-700: #495057 !default;
$gray-800: #020202 !default;
$gray-900: #212529 !default;
$black: #000 !default;

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
works if added in app.blade.php

# 1. [Discarded] Theme Landlord : Front
====================================================================
TODO comape them btn orignal and used in landlaord

use: <link rel="stylesheet" href="{{ asset('/assets/css/theme.css') }}">
=>> not theme.min.css. seems somethign is changed

landlord-app.blade.php => style="background-image: url(landlord/background/wave-pattern-light.svg);">
			to style="background-image: url('{{asset('/assets/wave-pattern-light.svg')}}');">
faq.blade. card-11
tos.blade.php card-11

icon: bootstrap icon	 <i class="bi bi-eye" style="font-size: 1.3rem;"></i>

-- Theme component Upgrade
- Front: bootstrap icon update from 1.9.1 to 1.11.3 by link

--re comiile Front [D:\xampp\htdocs\frontv431]

  --bs-blue: #377dff;
  --bs-indigo: #6610f2;
  --bs-purple: #6f42c1;
  --bs-pink: #d63384;
  --bs-red: #ed4c78;
  --bs-orange: #fd7e14;
  --bs-yellow: #f5ca99;
  --bs-green: #198754;
  --bs-teal: #00c9a7;
  --bs-cyan: #09a5be;
  --bs-gray-500: #97a4af;
  --bs-gray-600: #8c98a4;
  --bs-gray-700: #677788;
  --bs-gray-800: #71869d;
--bs-light: #f7faff;
  --bs-dark: #21325b;

bg-primary-subtle {
.bg-secondary-subtle {
.bg-success-subtle {
.bg-info-subtle {
.bg-warning-subtle {
.bg-danger-subtle {
.bg-light-subtle {
.bg-dark-subtle {


cmd>pythong -V
3.12.2

- isntall python module
distutils package is removed in python version 3.12
pip install setuptools

edit front ->src->css->theme.css
@media (min-width: 1200px) {
  .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1140px;
  }
}
to
@media (min-width: 1440px) {
  .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
  }
}

- delete most dppendency form old package.json

Font: file:///D:/xampp/htdocs/frontv431/dist/documentation/gulp.html
npm install --global gulp
npm install --global gulp-cli
npm install

- manually  install from old package.json
npm  install typed.js@2.0.12
npm  install dropzone@5.9.3
npm  install  chart.js@3.8.0

- Keep thes elower veirosn. Latest viso crceate isisue
npm isntall
quill
tom-select
swiper
imask
leafleat

- also check _front.scss

gulp
gulp dist	=> Ok
gulp build	=> OK
working
gulp
C:\Users\pulok\AppData\Local\npm-cache\_logs\2024-04-06T06_52_19_819Z-debug-0.log

- dont knwo how to exclue/remove any module from css etc?
src->asssets->scss/front->vendors
