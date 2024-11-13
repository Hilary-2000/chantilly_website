<!DOCTYPE html>
<html lang="en">
    {{-- header title favicon etc --}}
    <x-header title="Chantilly Schools Homepage"/>
<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu/>

    {{-- BODY STARTS HERE --}}
    <!--Slider Area Start-->
    <div class="slider-area slider-style-1">
        <div class="preview-2">
            <div id="nivoslider" class="slides">
                <img src="img/slider/11.jpg" alt="" title="#slider-1-caption1"/>
                <img src="img/slider/12.jpg" alt="" title="#slider-1-caption2"/>
                <img src="img/slider/13.jpg" alt="" title="#slider-1-caption3"/>
            </div>
            <div id="slider-1-caption1" class="nivo-html-caption nivo-caption">
                <div class="banner-content slider-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="text-content">
                                    <h4 class="title1" style="font-size: 25px;">Welcome To Chantilly Schools</h4>
                                    <p class="sub-title">Chantilly Schools is all about maximizing the potential of each student, <br>through continuous improvement <b>"Kaizen"</b>. We apply this philosophy in all areas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="slider-1-caption2" class="nivo-html-caption nivo-caption">
                <div class="banner-content slider-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="text-content slide-2 hidden-xs">
                                    <h4 class="title1" style="font-size: 25px;">Beyond Academic rigor</h4>
                                    <p class="sub-title">We offers Career Tours for our learners. <br>This introduce our learners to various career paths and inspire their future aspirations.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="slider-1-caption3" class="nivo-html-caption nivo-caption">
                <div class="banner-content slider-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="text-content slide-2 hidden-xs">
                                    <h4 class="title1" style="font-size: 25px;">Nothing Beats the excitement of Beamish School Trips</h4>
                                    <p class="sub-title">School trips are an exciting way to engage children in <br>learning and also make LEARNING unforgettable.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Slider Area-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer/>
</body>
</html>