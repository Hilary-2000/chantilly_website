<!DOCTYPE html>
<html lang="en">
    {{-- header title favicon etc --}}
    <x-header title="Chantilly Schools Homepage"/>
<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="home"/>

    {{-- BODY STARTS HERE --}}
    <!--Slider Area Start-->
    <div class="slider-area slider-style-1">
        <div class="preview-2">
            <div id="nivoslider" class="slides">
                @if (count($carrousel) > 0)
                    @foreach ($carrousel as $key => $item)
                        <img src="{{$item->carousel_image}}" alt="" title="#slider-1-caption{{$key}}"/>
                    @endforeach
                @endif
            </div>
            @if (count($carrousel) > 0)
                @foreach ($carrousel as $key => $item)
                    <div id="slider-1-caption{{$key}}" class="nivo-html-caption nivo-caption">
                        <div class="banner-content slider-1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7">
                                        <div class="text-content">
                                            <h4 class="title1" style="font-size: 25px;">{{$item->carrousel_title}}</h4>
                                            <p class="sub-title">{!!$item->carrousel_description!!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!--End of Slider Area-->
    
    @if (count($curricullum) > 0)
        <!--Class Area Start-->
        <div class="class-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-wrapper">
                            <div class="section-title">
                                <h3>Chantilly Schools</h3>
                                <p>Chantilly Schools offers Kenyan CBC Curricullum</p>
                            </div>
                        </div> 
                    </div>       
                </div>
                <div class="class-carousel carousel-style-one owl-carousel">
                    @foreach ($curricullum as $key => $item)
                        <div class="single-class">
                            <div class="single-class-image">
                                <a href="/ContactUs">
                                    <img src="{{$item->curriculum_image}}" alt="">
                                    <span class="class-date">Join <span>Now</span></span>
                                </a>
                            </div>
                            <div class="single-class-text">
                                <div class="class-des">
                                    <h4><a href="#">{{$item->curriculum_title}}</a></h4>
                                    <p>{{$item->curriculum_description}}</p>
                                </div>
                                <div class="class-schedule">
                                    <span>AGE: {{$item->curriculum_age_range}} years</span>
                                    <span>CLASSES PRESENT : {{$item->curriculum_classes}}</span>
                                    <span class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="single-class">
                        <div class="single-class-image">
                            <a href="/ContactUs">
                                <img src="img/class/2.jpg" alt="">
                                <span class="class-date">Join <span>Now</span></span>
                            </a>
                        </div>
                        <div class="single-class-text">
                            <div class="class-des">
                                <h4><a href="#">Primary</a></h4>
                                <p>Building core knowledge, critical thinking, and practical skills.</p>
                            </div>
                            <div class="class-schedule">
                                <span>AGE: 5 - 15 years</span>
                                <span>CLASSES PRESENT : 6</span>
                                <span class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="single-class">
                        <div class="single-class-image">
                            <a href="/ContactUs">
                                <img src="img/class/3.jpg" alt="">
                                <span class="class-date">Join <span>Now</span></span>
                            </a>
                        </div>
                        <div class="single-class-text">
                            <div class="class-des">
                                <h4><a href="#">Juniour Secondary</a></h4>
                                <p>Preparing students for advanced studies with an emphasis on competency and specialization.</p>
                            </div>
                            <div class="class-schedule">
                                <span>AGE: 12 - 18 years</span>
                                <span>CLASSES PRESENT : 3</span>
                                <span class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></span>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <!--End of Class Area-->
    @endif

    <!--Fun Factor Area Start-->
    <div class="fun-factor-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <div class="single-fun-factor">
                        <div class="fun-factor-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <h2><span class="counter">{{$homepage_stats['teachers'] ?? 0}}</span></h2>
                        <span>Teacher</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <div class="single-fun-factor">
                        <div class="fun-factor-icon">
                            <i class="fa fa-bank"></i>
                        </div>
                        <h2><span class="counter">{{$homepage_stats['classes'] ?? 0}}</span></h2>
                        <span>Classes</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <div class="single-fun-factor">
                        <div class="fun-factor-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <h2><span class="counter">{{$homepage_stats['students'] ?? 0}}</span></h2>
                        <span>Students</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Fun Factor Area-->
    
    <!--Service Area Start-->
    <div class="service-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title">
                            <h3>Other Services</h3>
                            <p>Our best services for your kids</p>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- MODAL STRUCTURE FOR THE CURRICULUMS --}}
                    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceForm" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editServiceForm">View Service</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <h6 id="service_title">No Title</h6>
                                        <div class="container w-100">
                                            <img src="" alt="" id="service_image">
                                        </div>
                                        <hr>
                                        <p id="service_description">Service description</p>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 border border-primary rounded py-2">
                    @if (count($services) > 0)
                        <div class="class-carousel carousel-style-one owl-carousel">
                            @foreach ($services as $key => $item)
                                <div class="single-class">
                                    <div class="single-class-image">
                                        <input type="hidden" value="{{json_encode($item)}}" id="service_data_{{$item->service_id}}" >
                                        <a href="#services_section" data-bs-toggle="modal" data-bs-target="#editServiceModal">
                                            <img src="{{$item->service_image}}" alt="">
                                            <span class="class-date view_service_data" id="view_service_data_{{$item->service_id}}">View <span>More</span></span>
                                        </a>
                                    </div>
                                    <div class="single-class-text">
                                        <div class="class-des">
                                            <h4><a href="#">{{$item->service_title}}</a></h4>
                                            <p>{{$item->service_description}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="class-list-text">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h3><a class="text-secondary" href="#">No Services present!</a></h3>
                                            </div>
                                        </div>
                                        <p>No Services present at the moment.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End of Service Area-->
    
    {{-- BODY ENDS HERE --}}
    <script>
        function hasJsonStructure(str) {
          if (typeof str !== "string") return false;
          try {
            const result = JSON.parse(str);
            const type = Object.prototype.toString.call(result);
            return type === "[object Object]" || type === "[object Array]";
          } catch (err) {
            return false;
          }
        }
        
        function cObj(objectid) {
            return document.getElementById(objectid);
        }

        window.addEventListener("load", function () {
            var view_service_data = document.getElementsByClassName("view_service_data");
            for (let index = 0; index < view_service_data.length; index++) {
                const element = view_service_data[index];
                element.addEventListener("click", function () {
                    var service_data = document.getElementById("service_data_"+element.id.substr(18)).value;
                    if (hasJsonStructure(service_data)) {
                        var decoded_json = JSON.parse(service_data);

                        cObj("service_image").src = decoded_json.service_image;
                        cObj("service_description").innerHTML = decoded_json.service_description;
                        cObj("service_title").innerHTML = decoded_json.service_title;
                    }
                });
            }
        });
    </script>

    {{-- FOOTER --}}
    <x-footer page="homepage"/>
</body>
</html>