
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
                        <span><i class="fa fa-map-marker"></i>{{session('school_address') ?? "Banana Raini Rd, off Limuru Road Ruaka, Karuri"}}</span>
                        <span><i class="fa fa-envelope"></i>{{session('school_email') ?? "info@chantillyschools.ac.ke"}}</span>
                        <span><i class="fa fa-phone"></i><a href="tel:{{session('school_phone') ?? "0714402822"}}" style="color: white;">{{session('school_phone') ?? "(254) 714 402 822"}}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widget-container section-padding">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="single-footer-widget">
                        <h4>Our School</h4>
                        <ul class="footer-widget-list">
                            <li><a href="/AboutUs">About Us</a></li>
                            <li><a href="/Events">Events</a></li>
                            <li><a href="/ContactUs">Contact Us</a></li>
                            <li><a href="/Vacancies">Become one of us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="single-footer-widget">
                        <h4>Links</h4>
                        <ul class="footer-widget-list">
                            <li><a href="/Events">Events</a></li>
                            <li><a href="/Gallery">Gallery</a></li>
                            <li><a href="/Downloads">Downloads</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
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

<!-- Google Map js
============================================ --> 		

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkvn-HZGqisswqVvIfekN-iMsj0swcTiM"></script>
<script src="https://www.google.com/jsapi"></script>
<script>
    function initialize() {
        var mapOptions = {
        zoom: 15,
        scrollwheel: false,
        center: new google.maps.LatLng(-1.1804595416946806, 36.7626112423361)
        };

        var map = new google.maps.Map(document.getElementById('googleMap'),
            mapOptions);


        var marker = new google.maps.Marker({
        position: map.getCenter(),
        animation:google.maps.Animation.BOUNCE,
        icon: '/img/map-marker.png',
        map: map
        });
    }
        
    google.maps.event.addDomListener(window, 'load', initialize);

    // get the page value
    var page = @json($page ?? '');
    if(page == "homepage"){
        setInterval(() => {
            if (document.getElementsByClassName("nivo-nextNav") > 0) {
                document.getElementsByClassName("nivo-nextNav")[0].click();
            }
        }, 10000);
    }
</script>	

<!-- main JS
============================================ -->		
<script src="/resources/js/main.js"></script>