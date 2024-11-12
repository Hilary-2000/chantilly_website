
<!--Footer Area Start-->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-info-container text-center section-padding">
                    <div class="footer-logo">
                        <a href="#"><img src="img/logo/chantilly_logo.png" alt=""></a>
                    </div>
                    <div class="footer-info">
                        <span><i class="fa fa-map-marker"></i>1st Floor New World Tower Miami</span>
                        <span><i class="fa fa-envelope"></i>admin@power-boosts.com</span>
                        <span><i class="fa fa-phone"></i>(801) 2345 - 6789</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widget-container section-padding">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <div class="single-footer-widget">
                        <h4>Our School</h4>
                        <ul class="footer-widget-list">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Become a Teacher</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <div class="single-footer-widget">
                        <h4>Links</h4>
                        <ul class="footer-widget-list">
                            <li><a href="#">Courses</a></li>
                            <li><a href="#">Events</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4">
                    <div class="single-footer-widget">
                        <h4>Support</h4>
                        <ul class="footer-widget-list">
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Forums</a></li>
                            <li><a href="#">Language Packs</a></li>
                            <li><a href="#">Release Status</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="subscribe-container">
                        <p>Subscribe now and receive weekly newsletter with educational materials, new courses, interesting posts, popular books and much more!</p>
                        <form action="#">
                            <div class="subscribe-form">
                                <input type="email" name="email" placeholder="Your email here">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-container">
                    <div class="row">
                        <div class="col-lg-6">
                            <span>&copy; {{date("Y")}} <a href="#">Power-Boosts</a>. All rights reserved</span>
                        </div>
                        <div class="col-lg-6">
                            <div class="social-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script>
<script src="https://www.google.com/jsapi"></script>
<script>
    function initialize() {
        var mapOptions = {
        zoom: 15,
        scrollwheel: false,
        center: new google.maps.LatLng(23.763494, 90.432226)
        };

        var map = new google.maps.Map(document.getElementById('googleMap'),
            mapOptions);


        var marker = new google.maps.Marker({
        position: map.getCenter(),
        animation:google.maps.Animation.BOUNCE,
        icon: 'img/map-marker.png',
        map: map
        });
        
    }
        
    google.maps.event.addDomListener(window, 'load', initialize);
</script>	

<!-- main JS
============================================ -->		
<script src="/resources/js/main.js"></script>