@extends('layouts.landlord')
@section('title','Product Overview')

@section('content')
    <!-- Features -->
    <div class="container content-space-2 content-space-lg-3">
        <div class="row align-items-lg-center">
        <div class="col-lg-5 mb-5 mb-lg-0">
            <div class="pe-lg-6">
            <div class="mb-4">
                <h2 class="h1">All-in-one</h2>
            </div>
    
            <div class="d-flex gap-3 mb-4">
                <img class="avatar avatar-xss avatar-4x3" src="../assets/svg/brands/slack-icon.svg" alt="Logo">
                <img class="avatar avatar-xss avatar-4x3" src="../assets/svg/brands/jira-icon.svg" alt="Logo">
                <img class="avatar avatar-xss avatar-4x3" src="../assets/svg/brands/gitlab-icon.svg" alt="Logo">
            </div>
    
            <div class="mb-4">
                <p>Front is a collaboration hub for work, no matter what work you do. It's a place where conversations happen, decisions are made, and information is always at your fingertips. With Front, your team is better connected.</p>
            </div>
    
            <a class="link" href="#">Get started <i class="bi-chevron-right small ms-1"></i></a>
            </div>
        </div>
        <!-- End Col -->
    
        <div class="col-lg-7">
            <!-- Browser Device -->
            <figure class="device-browser">
            <div class="device-browser-header">
                <div class="device-browser-header-btn-list">
                <span class="device-browser-header-btn-list-btn"></span>
                <span class="device-browser-header-btn-list-btn"></span>
                <span class="device-browser-header-btn-list-btn"></span>
                </div>
                <div class="device-browser-header-browser-bar">www.htmlstream.com/front/</div>
            </div>
    
            <div class="device-browser-frame">
                <img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img1.jpg') }}" alt="Image Description">
            </div>
            </figure>
            <!-- End Browser Device -->
        </div>
        <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Features -->

    <!-- Features -->
    <div class="container content-space-2 content-space-lg-3">
        <div class="row justify-content-lg-between align-items-lg-center">
        <div class="col-lg-5 mb-9 mb-lg-0">
            <div class="mb-3">
            <h2 class="h1">Whatever work you do, use our design</h2>
            </div>
    
            <p>After brainstorming about insights, get the power to create something real. Bring your ideas to life and share your vision with concrete elements. Make collaboration and communication easier with your team or your client.</p>
    
            <p>Use our tools to explore your ideas and make your vision come true. Then share your work easily.</p>
    
            <div class="mt-4">
            <a class="btn btn-primary btn-transition px-5" href="#">Start Now</a>
            </div>
        </div>
        <!-- End Col -->
    
        <div class="col-lg-6 col-xl-5">
            <!-- SVG Element -->
            <div class="position-relative mx-auto" style="max-width: 28rem; min-height: 30rem;">
            <figure class="position-absolute top-0 end-0 zi-2 me-10" data-aos="fade-up">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 450 450" width="165" height="165">
                <g>
                    <defs>
                    <path id="circleImgID2" d="M225,448.7L225,448.7C101.4,448.7,1.3,348.5,1.3,225l0,0C1.2,101.4,101.4,1.3,225,1.3l0,0
                        c123.6,0,223.7,100.2,223.7,223.7l0,0C448.7,348.6,348.5,448.7,225,448.7z"/>
                    </defs>
                    <clipPath id="circleImgID1">
                    <use xlink:href="#circleImgID2"/>
                    </clipPath>
                    <g clip-path="url(#circleImgID1)">
                    <image width="450" height="450" xlink:href="{{ Storage::disk('s3l')->url('img/450x450/img1.jpg') }}" ></image>
                    </g>
                </g>
                </svg>
            </figure>
    
            <figure class="position-absolute top-0 start-0" data-aos="fade-up" data-aos-delay="300">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 335.2 335.2" width="120" height="120">
                <circle fill="none" stroke="#377dff" stroke-width="75" cx="167.6" cy="167.6" r="130.1"/>
                </svg>
            </figure>
    
            <figure class="d-none d-sm-block position-absolute top-0 start-0 mt-10" data-aos="fade-up" data-aos-delay="200">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 515 515" width="200" height="200">
                <g>
                    <defs>
                    <path id="circleImgID4" d="M260,515h-5C114.2,515,0,400.8,0,260v-5C0,114.2,114.2,0,255,0h5c140.8,0,255,114.2,255,255v5
                        C515,400.9,400.8,515,260,515z"/>
                    </defs>
                    <clipPath id="circleImgID3">
                    <use xlink:href="#circleImgID4"/>
                    </clipPath>
                    <g clip-path="url(#circleImgID3)">
                    <image width="515" height="515" xlink:href="../assets/img/515x515/img1.jpg" transform="matrix(1 0 0 1 1.639390e-02 2.880859e-02)"></image>
                    </g>
                </g>
                </svg>
            </figure>
    
            <figure class="position-absolute top-0 end-0" style="margin-top: 11rem; margin-right: 13rem;" data-aos="fade-up" data-aos-delay="250">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 67 67" width="25" height="25">
                <circle fill="#00C9A7" cx="33.5" cy="33.5" r="33.5"/>
                </svg>
            </figure>
    
            <figure class="position-absolute top-0 end-0 me-3" style="margin-top: 8rem;" data-aos="fade-up" data-aos-delay="350">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 141 141" width="50" height="50">
                <circle fill="#FFC107" cx="70.5" cy="70.5" r="70.5"/>
                </svg>
            </figure>
    
            <figure class="position-absolute bottom-0 end-0" data-aos="fade-up" data-aos-delay="400">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 770.4 770.4" width="280" height="280">
                <g>
                    <defs>
                    <path id="circleImgID6" d="M385.2,770.4L385.2,770.4c212.7,0,385.2-172.5,385.2-385.2l0,0C770.4,172.5,597.9,0,385.2,0l0,0
                        C172.5,0,0,172.5,0,385.2l0,0C0,597.9,172.4,770.4,385.2,770.4z"/>
                    </defs>
                    <clipPath id="circleImgID5">
                    <use xlink:href="#circleImgID6"/>
                    </clipPath>
                    <g clip-path="url(#circleImgID5)">
                    <image width="900" height="900" xlink:href="../assets/img/900x900/img2.jpg" transform="matrix(1 0 0 1 -64.8123 -64.8055)"></image>
                    </g>
                </g>
                </svg>
            </figure>
            </div>
            <!-- End SVG Element -->
        </div>
        <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Features -->

    <!-- Features -->
    <div class="position-relative bg-light rounded-2 mx-3 mx-lg-10">
        <div class="container content-space-2 content-space-lg-3">
        <!-- Heading -->
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5">
            <h2>Wow your audience from the first second</h2>
            <p>The powerful and flexible theme for all kinds of businesses</p>
        </div>
        <!-- End Heading -->
    
        <div class="text-center mb-10">
            <!-- List Checked -->
            <ul class="list-inline list-checked list-checked-primary">
            <li class="list-inline-item list-checked-item">Responsive</li>
            <li class="list-inline-item list-checked-item">5-star support</li>
            <li class="list-inline-item list-checked-item">Constant updates</li>
            </ul>
            <!-- End List Checked -->
        </div>
    
        <div class="row">
            <div class="col-lg-7 mb-9 mb-lg-0">
            <div class="pe-lg-6">
                <!-- Browser Device -->
                <figure class="device-browser">
                <div class="device-browser-header">
                    <div class="device-browser-header-btn-list">
                    <span class="device-browser-header-btn-list-btn"></span>
                    <span class="device-browser-header-btn-list-btn"></span>
                    <span class="device-browser-header-btn-list-btn"></span>
                    </div>
                    <div class="device-browser-header-browser-bar">www.htmlstream.com/front/</div>
                </div>
    
                <div class="device-browser-frame">
                    <img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img6.jpg') }}" alt="Image Description">
                </div>
                </figure>
                <!-- End Browser Device -->
            </div>
            </div>
            <!-- End Col -->
    
            <div class="col-lg-5">
            <!-- Heading -->
            <div class="mb-4">
                <h2>Collaborative tools to design user experience</h2>
                <p>We help businesses bring ideas to life in the digital world, by designing and implementing the technology tools that they need to win.</p>
            </div>
            <!-- End Heading -->
    
            <!-- List Checked -->
            <ul class="list-checked list-checked-primary mb-5">
                <li class="list-checked-item">Less routine – more creativity</li>
                <li class="list-checked-item">Hundreds of thousands saved</li>
                <li class="list-checked-item">Scale budgets efficiently</li>
            </ul>
            <!-- End List Checked -->
    
            <a class="btn btn-primary" href="#">Get started</a>
    
            <hr class="my-5">
    
            <span class="d-block">Trusted by leading companies</span>
    
            <div class="row">
                <div class="col py-3">
                <img class="avatar avatar-4x3" src="../assets/svg/brands/fitbit-dark.svg" alt="Logo">
                </div>
                <!-- End Col -->
    
                <div class="col py-3">
                <img class="avatar avatar-4x3" src="../assets/svg/brands/forbes-dark.svg" alt="Logo">
                </div>
                <!-- End Col -->
    
                <div class="col py-3">
                <img class="avatar avatar-4x3" src="../assets/svg/brands/mailchimp-dark.svg" alt="Logo">
                </div>
                <!-- End Col -->
    
                <div class="col py-3">
                <img class="avatar avatar-4x3" src="../assets/svg/brands/layar-dark.svg" alt="Logo">
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
        </div>
    </div>
    <!-- End Features -->
@endsection
@section('bo04-content')


        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <img src="{{asset('/site/images/about.jpg')}}" class="img-fluid rounded shadow" alt="">
                </div><!--end col-->

                <div class="col-lg-7 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                    <div class="section-title ms-lg-5">
                        <h4 class="title mb-3">ANYPO - Procurment proces simplied!</h4>
                        <p class="text-muted">This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression of the final publication is not compromised.</p>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-0"><span class="text-dark h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>Beautiful and easy to understand animations</li>
                            <li class="mb-0"><span class="text-dark h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>Our Talented & Experienced Marketing Agency</li>
                            <li class="mb-0"><span class="text-dark h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>Theme advantages are pixel perfect design</li>
                        </ul>                        
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->


        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 text-center features feature-clean bg-transparent">
                        <div class="icons text-primary text-center mx-auto">
                            <i class="uil uil-phone d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-3">
                            <h5 class="footer-head">Phone</h5>
                            <p class="text-muted">Start working with Starty that can provide everything</p>
                            <a href="tel:+152534-468-854" class="text-foot">+152 534-468-854</a>
                        </div>
                    </div>
                </div><!--end col-->
                
                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card border-0 text-center features feature-clean bg-transparent">
                        <div class="icons text-primary text-center mx-auto">
                            <i class="uil uil-envelope d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-3">
                            <h5 class="footer-head">Email</h5>
                            <p class="text-muted">Start working with Starty that can provide everything</p>
                            <a href="mailto:contact@example.com" class="text-foot">contact@example.com</a>
                        </div>
                    </div>
                </div><!--end col-->
                
                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card border-0 text-center features feature-clean bg-transparent">
                        <div class="icons text-primary text-center mx-auto">
                            <i class="uil uil-map-marker d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-3">
                            <h5 class="footer-head">Location</h5>
                            <p class="text-muted">C/54 Northwest Freeway, Suite 558, <br>Houston, USA 485</p>
                            <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin"
                                data-type="iframe" class="video-play-icon text-foot lightbox">View on Google map</a>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title mb-5 pb-2 text-center">
                        <h4 class="title mb-3">Get In Touch !</h4>
                        <p class="text-muted para-desc mx-auto mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
                    </div>
                    <div class="custom-form">
                        <form method="post" name="myForm" id="myForm" onsubmit="return validateForm()">
                            <p id="error-msg" class="mb-0"></p>
                            <div id="simple-msg"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                            <input name="name" id="name" type="text" class="form-control" placeholder="Name :">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Email :">
                                    </div> 
                                </div><!--end col-->

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Subject</label>
                                            <input name="subject" id="subject" class="form-control" placeholder="Subject :">
                                    </div>
                                </div><!--end col-->

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Comments <span class="text-danger">*</span></label>
                                            <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Message :"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div><!--end custom-form-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        <div class="container-fluid mt-100 mt-60">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="card map border-0">
                        <div class="card-body p-0">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        

@endsection