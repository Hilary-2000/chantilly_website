<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="About Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="aboutus"/>

    {{-- BODY STARTS HERE --}}
    <!--Breadcrumb Banner Area Start-->
    <div class="breadcrumb-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-text">
                        <h1 class="text-center">About Us</h1>
                        <div class="breadcrumb-bar">
                            <ul class="breadcrumb">
                                <li><a href="/">Home</a></li>
                                <li>About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Breadcrumb Banner Area-->

    <!--About Area Start-->
    <div class="about-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title">
                            <h3>OUR HISTORY</h3>
                            <p>Find out where, when and how we started and became.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text-container">
                        {!!$history[0]->history_details!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="skill-image my-auto">
                        <img src="{{$history_image[0]->image_location}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of About Area-->
    
    <!--Teachers Column Carousel Start-->
    <div class="teachers-column-carousel-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title">
                            <h3>Our Awards</h3>
                            <p>We are glad to showcase our awards a true testament of our prowess.</p>
                        </div>
                    </div> 
                </div>       
            </div>
            @if (count($awards) > 0)
                <div class="teachers-column-carousel carousel-style-one owl-carousel">
                    @foreach ($awards as $key => $award)
                        <div class="single-teachers-column text-center">
                            <div class="teachers-image-column">
                                <a href="#">
                                    <img src="{{$award->award_image}}" alt="">
                                    <span class="image-hover">
                                        <span>{{date("D dS M Y", strtotime($award->award_date))}}</span>
                                    </span>
                                </a>
                            </div>
                            <div class="teacher-column-carousel-text">
                                <h4>{{$award->award_title}}</h4>
                                <span>{{date("D dS M Y", strtotime($award->award_date))}}</span>
                                <p>{{$award->award_description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!--End of Teachers Column Carousel-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer page="aboutus" />
</body>

</html>
