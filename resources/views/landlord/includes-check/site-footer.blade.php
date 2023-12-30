
<!-- Footer Start -->
<footer class="footer bg-footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-py-60">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0 order-4 order-md-1">
                            <ul class="list-unstyled social-icon foot-social-icon mb-0">
                                <li class="list-inline-item"><a href="https://1.envato.market/starty" target="_blank" class="rounded"><i class="uil uil-shopping-cart align-middle" title="Buy Now"></i></a></li>
                                <li class="list-inline-item"><a href="https://dribbble.com/shreethemes" target="_blank" class="rounded"><i class="uil uil-dribbble align-middle" title="dribbble"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.behance.net/shreethemes" target="_blank" class="rounded"><i class="uil uil-behance" title="Behance"></i></a></li>
                                <li class="list-inline-item"><a href="http://linkedin.com/company/shreethemes" target="_blank" class="rounded"><i class="uil uil-linkedin" title="Linkedin"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.facebook.com/shreethemes" target="_blank" class="rounded"><i class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/shreethemes/" target="_blank" class="rounded"><i class="uil uil-instagram align-middle" title="instagram"></i></a></li>
                                <li class="list-inline-item"><a href="https://twitter.com/shreethemes" target="_blank" class="rounded"><i class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                                <li class="list-inline-item"><a href="mailto:support@shreethemes.in" class="rounded"><i class="uil uil-envelope align-middle" title="email"></i></a></li>
                                
                                <li class="list-inline-item"><a href="https://forms.gle/QkTueCikDGqJnbky9" target="_blank" class="rounded"><i class="uil uil-file align-middle" title="customization"></i></a></li>
                            </ul><!--end icon-->
                        </div><!--end col-->

                        <div class="col-lg-3 col-md-3 col-12 order-1 order-md-2">
                            <h6 class="footer-head">Company</h6>
                            <ul class="list-unstyled footer-list mt-4">

                                <li><a href="{{ route('about') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> About us</a></li>
                                <li><a href="{{ route('product') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> {{ config('app.name') }}</a></li>
                                <li><a href="{{ route('home.pricing') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Pricing</a></li>
                                <li><a href="{{ route('faq') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> FAQ</a></li>
                                <li><a href="{{ route('contact-us') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Contact Us</a></li>

                                {{-- <li><a href="page-team.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Team</a></li>
                                <li><a href="portfolio-detail-four.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Project</a></li> --}}
                            </ul>
                        </div><!--end col-->
                        
                        <div class="col-lg-3 col-md-3 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0 order-2 order-md-3">
                            <h6 class="footer-head">Usefull Links</h6>
                            <ul class="list-unstyled footer-list mt-4">
                                <li><a href="{{ route('tos') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Terms of Services</a></li>
                                <li><a href="{{ route('privacy') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Privacy Policy</a></li>
                                <li><a href="{{ route('contact-us') }}" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Contact Us</a></li>
                                <li><a href="index.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Changelog</a></li>
                                {{-- <li><a href="page-elements.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Components</a></li> --}}
                            </ul>
                        </div><!--end col-->

                        <div class="col-lg-3 col-md-3 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0 order-3 order-md-4">
                            <h6 class="footer-head">Resources</h6>
                            <ul class="list-unstyled footer-list mt-4">
                                <li><a href="page-faqs.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Theme guide</a></li>
                                <li><a href="page-faqs.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Support desk</a></li>
                                <li><a href="page-services.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> What we offer</a></li>
                                <li><a href="page-aboutus.html" class="text-foot"><i class="uil uil-angle-right-b me-1"></i> Company history</a></li>
                            </ul>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="footer-py-30 footer-bar bg-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <div class="text-xs text-start pb-3">
                        @auth
                            Welcome {{ auth()->user()->name }} {{ '| '.auth()->user()->id .' |' }}  {{ auth()->user()->email .' |' }}
                            @if ( auth()->user()->role->value == UserRoleEnum::USER->value )
                                <span class="text-danger">user </span>|
                            @else
                                <a class="text-foot" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'user']) }}">user</a> |
                            @endif

                            @if ( auth()->user()->role->value == UserRoleEnum::ADMIN->value)
                                <span class="text-danger">admin </span>|
                            @else
                                <a class="text-foot" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'admin']) }}">admin</a> |
                            @endif


                            @if ( auth()->user()->role->value == UserRoleEnum::SUPPORT->value)
                                <span class="text-danger">agent </span>|
                            @else
                                <a class="text-foot" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'agent']) }}">agent</a> |
                            @endif

                            @if ( auth()->user()->role->value == UserRoleEnum::SUPERVISOR->value)
                                <span class="text-danger">supervisor </span>|
                            @else
                                <a class="text-foot" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'supervisor']) }}">supervisor</a> |
                            @endif

                            @if ( auth()->user()->role->value == UserRoleEnum::SYSTEM->value)
                                <span class="text-danger">system </span> |
                            @else
                                <a class="text-foot" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'system']) }}">system</a> |
                            @endif
                            Account: {{ (auth()->user()->account_id == '') ? 'NULL' : auth()->user()->account_id }} 
                        @endauth
                        @guest
                            Welcome Guest. Please  <a class="text-foot" href="{{ route('login') }}" class="text-warning">Login</a> here.
                        @endguest
                        
                    </div>
                </div><!--end col-->

                <div class="col-sm-4 mt-4 mt-sm-0">
                    <div class="text-sm-end text-center">
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row align-items-center">
                <div class="col-sm-4">
                    <div class="text-sm-start text-center">
                        <a href="#">
                            <img src="{{asset('/site/images/logo-light.png')}}" height="26" alt="">
                        </a>
                    </div>
                </div><!--end col-->

                <div class="col-sm-8 mt-4 mt-sm-0">
                    <div class="text-sm-end text-center">
                        <p class="text-xs mb-0 text-muted">
                            <a href="{{ route('privacy') }}" class="text-reset">Privacy Policy</a>
                            | <a href="{{ route('tos') }}" class="text-reset">Terms of Use </a>
                            | <script>document.write(new Date().getFullYear())</script> © <a href="https://hawarIT.com/" target="_blank" class="text-reset">HawarIT Limited</a>.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </div>
</footer><!--end footer-->
<!-- End -->

<!-- Back to top -->
{{-- <ul class="text-center list-unstyled switcher-button mb-0 position-fixed" style="top: 20%; left: 10px; z-index: 2;">
    <li class="d-grid"><a href="javascript:void(0)" class="btn btn-icon rounded-circle btn-dark dark-version t-dark" onclick="setTheme('style-dark')"> <i class="uil uil-moon fs-5"></i> </a></li>
    <li class="d-grid"><a href="javascript:void(0)" class="btn btn-icon rounded-circle btn-dark light-version t-light" onclick="setTheme('style')"> <i class="uil uil-sun fs-5"></i> </a></li>
    <li class="d-grid"><a href="https://1.envato.market/starty" target="_blank" class="btn btn-icon rounded-circle btn-primary mt-2"> <i class="uil uil-shopping-cart fs-5"></i> </a></li>
</ul> --}}
<a href="javascript:void(0)" onclick="topFunction()" id="back-to-top" class="back-to-top rounded-pill"><i class="mdi mdi-arrow-up"></i></a>
<!-- Back to top -->

<!-- javascript -->
{{-- <script src="js/bootstrap.bundle.min.js"></script> --}}
{{-- <script src="js/tiny-slider.js"></script> --}}
{{-- <script src="js/feather.min.js"></script> --}}

<script src="{{asset('/site/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/site/js/tiny-slider.js')}}"></script>
<script src="{{asset('/site/js/feather.min.js')}}"></script>
<!-- Main Js -->
{{-- <script src="js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.--> --}}
{{-- <script src="js/app.js"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. --> --}}

<script src="{{asset('/site/js/plugins.init.js')}}"></script>
<script src="{{asset('/site/js/app.js')}}"></script>