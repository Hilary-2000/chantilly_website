
<!--Footer Area Start-->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-info-container text-center section-padding">
                    <div class="footer-logo">
                        <a href="#"><img style="max-height: 100px;" src="{{ session('school_logo') ?? "/img/logo/chantilly_logo.png" }}" alt="CHANTILLY SCHOOL"></a>
                    </div>
                    <div class="footer-info">
                        <span><i class="fa fa-map-marker"></i>{!!session('school_pin_location') ? '<a target="_blank" class="text-white" href="https://www.google.com/maps?q='.session('school_pin_location').'" class=""><u>'.(session('school_address') ?? "Banana Raini Rd, off Limuru Road Ruaka, Karuri").'</u></a>' : session('school_address') ?? "Banana Raini Rd, off Limuru Road Ruaka, Karuri" !!}</span>
                        <span><a class="text-white" href="mailto:{{session('school_email') ?? "info@chantillyschools.ac.ke"}}"><i class="fa fa-envelope"></i>{{session('school_email') ?? "info@chantillyschools.ac.ke"}}</a></span>
                        <span><i class="fa fa-phone"></i><a href="tel:{{session('school_phone') ?? "0714402822"}}" style="color: white;">{{session('school_phone') ?? "(254) 714 402 822"}}</a></span>
                    </div>
                    <div class="row w-50 mx-auto my-2">
                        <hr class="bg-white white">
                            <div class="social-links">
                                <a target="_blank" href="{{ session('school_facebook') ?? "https://www.facebook.com/chantillyschools/" }}"><i class="fa fa-facebook"></i></a>
                                <a target="_blank" href="{{ session('school_instagram') ?? "https://www.instagram.com/chantillyschools.kaizen/" }}"><i class="fa fa-instagram"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widget-container section-padding">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="single-footer-widget">
                        <h4>Quick Links</h4>
                        <ul class="footer-widget-list">
                            <li><a href="/AboutUs">About Us</a></li>
                            <li><a href="/ContactUs">Contact Us</a></li>
                            <li><a href="/Gallery">Gallery</a></li>
                            <li><a href="/Vacancies">Vacancies</a></li>
                            <li><a href="/Events">Events</a></li>
                            <li><a href="/Downloads">Downloads</a></li>
                            <li><a href="/ExtraCurriculum">Extra Curriculum</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 d-none">
                    <div class="single-footer-widget">
                        <h4>Links</h4>
                        <ul class="footer-widget-list">
                            <li><a href="/Events">Events</a></li>
                            <li><a href="/Gallery">Gallery</a></li>
                            <li><a href="/Downloads">Downloads</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 d-none">
                    <div class="single-footer-widget">
                        <h4>Support</h4>
                        <ul class="footer-widget-list">
                            <li><a href="/Downloads">Downloads</a></li>
                            <li><a href="/Vacancies">Vacancies</a></li>
                            <li><a href="/ContactUs">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-container">
                    <div class="row">
                        <div class="col-lg-4">
                            <span>&copy; {{date("Y")}} <a href="#">{{session('school_name') ?? "Chantilly Schools"}}</a>. All rights reserved</span>
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            <div class="social-links">
                                <a target="_blank" href="{{ session('school_facebook') ?? "https://www.facebook.com/chantillyschools/" }}"><i class="fa fa-facebook"></i></a>
                                <a target="_blank" href="{{ session('school_instagram') ?? "https://www.instagram.com/chantillyschools.kaizen/" }}"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Footer Area-->


<!-- jquery
============================================ -->		
<script src="/resources/js/vendor/jquery-1.12.4.min.js"></script>

<!-- Popper JS
============================================ -->		
<script src="/resources/js/popper.js"></script>

<!-- bootstrap JS
============================================ -->		
<script src="/resources/js/bootstrap.min.js"></script>

<!-- bootstrap Toggle JS
============================================ -->		
<script src="/resources/js/bootstrap-toggle.min.js"></script>

<!-- nivo slider js
============================================ -->       
<script src="/resources/css/lib/nivo-slider/js/jquery.nivo.slider.js"></script>
<script src="/resources/css/lib/nivo-slider/home.js"></script>

<!-- wow JS
============================================ -->		
<script src="/resources/js/wow.min.js"></script>

<!-- meanmenu JS
============================================ -->		
<script src="/resources/js/jquery.meanmenu.js"></script>

<!-- Owl carousel JS
============================================ -->		
<script src="/resources/js/owl.carousel.min.js"></script>

<!-- Countdown JS
============================================ -->		
<script src="/resources/js/jquery.countdown.min.js"></script>

<!-- scrollUp JS
============================================ -->		
<script src="/resources/js/jquery.scrollUp.min.js"></script>

<!-- Waypoints JS
============================================ -->		
<script src="/resources/js/waypoints.min.js"></script>

<!-- Counterup JS
============================================ -->		
<script src="/resources/js/jquery.counterup.min.js"></script>

<!-- Slick JS
============================================ -->		
<script src="/resources/js/slick.min.js"></script>

<!-- Mix It Up JS
============================================ -->		
<script src="/resources/js/jquery.mixitup.js"></script>

<!-- Venubox JS
============================================ -->		
<script src="/resources/js/venobox.min.js"></script>

<!-- plugins JS
============================================ -->		
<script src="/resources/js/plugins.js"></script>

<!-- main JS
============================================ -->		
<script src="/resources/js/main.js"></script>