<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Chantilly Schools Homepage" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_home" />

    {{-- BODY STARTS HERE --}}
    <!--Slider Area Start-->
    <div class="class-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title" id="carrousel_section">
                            <h3>Edit Carousels</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2 border-bottom border-secondary py-2">
                <div class="col-md-9">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success py-1 text-center my-1">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger py-1 text-center my-1">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary btn-sm {{count($homepage_carrousels) >=5 ? "disabled" : ""}}"  data-bs-toggle="modal" data-bs-target="#contactFormModal"><i class="fa fa-plus"></i> Add Caroussel</button>
                    <p class="text-success {{count($homepage_carrousels) >=5 ? "" : "d-none"}}">Upto Five carrousels allowed!</p>
                </div>
                
                <!-- Modal Structure -->
                <div class="modal fade" id="contactFormModal" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h6 class="modal-title" id="contactFormModalLabel">Contact Form</h6>
                                <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="contact-form-container">
                                    <form id="contact-form" action="/Homepage/saveCarousel" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" name="caroussel_title" class="form-control" placeholder="Carrousel title *" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="file" name="caroussel_img" class="form-control" accept=".jpg, .jpeg, .png, .gif" required>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="caroussel_description" class="form-control" placeholder="Your Carrousel Description" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Save</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this carrousel? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="#" class="btn btn-danger" id="confirmDeleteCorrousel"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    @if (count($homepage_carrousels) > 0)
                        @foreach ($homepage_carrousels as $key => $homepage_carrousel)
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <a href="#"><img src="{{$homepage_carrousel->carousel_image}}" alt=""></a>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h3><a href="#">{{$homepage_carrousel->carrousel_title}}</a></h3>
                                                </div>
                                                <input type="hidden" id="carrousel_{{$key}}" value="{{json_encode($homepage_carrousel)}}">
                                                <div class="col-md-3">
                                                    <button class="btn btn-sm btn-success edit_carrousel" type="button" id="edit_carrousel_{{$key}}" title="Edit Caroussel!"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-sm btn-danger delete_carrousel" id="delete_carrousel_{{$key}}" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-placement="top" title="Delete Carrousel!"><i class="fa fa-trash"></i></button>
                                                    <a href="/Homepage/displayCarousel/{{$homepage_carrousel->carrousel_id}}" class="btn btn-sm {{$homepage_carrousel->display == "1" ? "btn-primary" : "btn-warning"}}" data-bs-placement="top" title="Change display status!"><i class="fa {{$homepage_carrousel->display == "1" ? "fa-eye" : "fa-eye-slash"}}"></i></a>
                                                </div>
                                            </div>
                                            <div class="class-information">
                                                <span><b><u>Title</u></b>:</span>
                                                <span>{{$homepage_carrousel->carrousel_title}}</span>
                                            </div>
                                            <span><b><u>Description</u></b>:</span>
                                            <p>{{$homepage_carrousel->carrousel_description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="class-list-text">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h3><a href="#">No Carrousel Set</a></h3>
                                            </div>
                                        </div>
                                        <p>No Caroussels set at the moment.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-4 border rounded border-secondary p-2" id="edit_carrousels">
                    <div class="single-widget-item res-mrg-top-xs">
                        <div class="single-title">
                            <h3 class="text-center">Select Carousel to Edit</h3>
                        </div>
                        <div class="contact-form">
                            {{-- <div class="w-100 container p-3 bg-success border-top border-dark border-2 my-2"></div> --}}
                            <div class="contact-form-container">
                                <form id="contact-form" action="/Homepage/updateCarousel" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <a href="path/to/your-file.pdf" class="d-none" id="download_carrousel" download>
                                        <i class="fa fa-download text-success"> Download Image</i>
                                    </a>
                                    <input type="hidden" name="carrousel_id" required id="carrousel_id">
                                    <input type="text" name="carrousel_title" required id="carrousel_title" placeholder="Carrousel Title *">
                                    <input type="file" name="carrousel_image" required id="carrousel_image" placeholder="Carrousel File *" accept=".jpg, .jpeg, .png, .gif">
                                    <textarea name="carrousel_description" required id="carrousel_description" placeholder="Your Carrousel Description"></textarea>
                                    <button type="submit" class="button-default button-yellow submit w-100"><i
                                            class="fa fa-save"></i>Update</button>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of slider Area-->

    <!--Class Area Start-->
    <div class="class-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title">
                            <h3>Edit Chantilly Curricullum</h3>
                            <p>Edit to show the classes present and whats is offered in those classes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget-item res-mrg-top-xs">
                        <div class="single-title">
                            <h3 class="text-center">Select curricullum to edit</h3>
                        </div>
                        <div class="contact-form">
                            <div class="w-100 container p-3 bg-success border-top border-dark border-2 my-2"></div>
                            <div class="contact-form-container">
                                <form id="contact-form" action="#" method="post">
                                    <input type="text" name="name" placeholder="Level Name e.g, Pre-Primary *">
                                    <input type="text" name="name" placeholder="Age range e.g, 2 - 6 Yrs *">
                                    <input type="text" name="name" placeholder="Level Name e.g, Pre-Primary *">
                                    <input type="file" name="name" placeholder="Carrousel Title *" accept=".jpg, .jpeg, .png, .gif">
                                    <textarea name="message" class="yourmessage" placeholder="Your Carrousel Description"></textarea>
                                    <button type="submit" class="button-default button-yellow submit w-100"><i
                                            class="fa fa-save"></i>Save</button>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 border border-primary rounded py-2">
                    <div class="class-carousel carousel-style-one owl-carousel">
                        <div class="single-class">
                            <div class="single-class-image">
                                <a href="/ContactUs">
                                    <img src="/img/class/1.jpg" alt="">
                                    <span class="class-date">Edit <span>Now</span></span>
                                </a>
                            </div>
                            <div class="single-class-text">
                                <div class="class-des">
                                    <h4><a href="#">Pre-Primary</a></h4>
                                    <p>Early childhood education focusing on foundational skills and holistic development.</p>
                                </div>
                                <div class="class-schedule">
                                    <span>AGE: 2 - 6 Yrs</span>
                                    <span>CLASSES : 3</span>
                                    <span class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-class">
                            <div class="single-class-image">
                                <a href="/ContactUs">
                                    <img src="/img/class/2.jpg" alt="">
                                    <span class="class-date">Edit <span>Now</span></span>
                                </a>
                            </div>
                            <div class="single-class-text">
                                <div class="class-des">
                                    <h4><a href="#">Primary</a></h4>
                                    <p>Building core knowledge, critical thinking, and practical skills.</p>
                                </div>
                                <div class="class-schedule">
                                    <span>AGE: 5 - 15 Yrs</span>
                                    <span>CLASSES : 6</span>
                                    <span class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="single-class">
                            <div class="single-class-image">
                                <a href="/ContactUs">
                                    <img src="/img/class/3.jpg" alt="">
                                    <span class="class-date">Edit <span>Now</span></span>
                                </a>
                            </div>
                            <div class="single-class-text">
                                <div class="class-des">
                                    <h4><a href="#">Juniour Secondary</a></h4>
                                    <p>Preparing students for advanced studies with an emphasis on competency and
                                        specialization.</p>
                                </div>
                                <div class="class-schedule">
                                    <span>AGE: 12 - 18 Yrs</span>
                                    <span>CLASSES : 3</span>
                                    <span class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Class Area-->

    <!--Fun Factor Area Start-->
    <div class="fun-factor-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="single-fun-factor">
                                <div class="fun-factor-icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <h2><span class="counter">25</span></h2>
                                <span>Teacher</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="single-fun-factor">
                                <div class="fun-factor-icon">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <h2><span class="counter">21</span></h2>
                                <span>Classes</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="single-fun-factor">
                                <div class="fun-factor-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <h2><span class="counter">450</span></h2>
                                <span>Students</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-white rounded p-2">
                    <div class="single-widget-item res-mrg-top-xs">
                        <div class="single-title">
                            <h3 class="text-center">Edit Stats</h3>
                        </div>
                        <div class="contact-form">
                            <div class="w-100 container p-3 bg-success border-top border-dark border-2 my-2"></div>
                            <div class="contact-form-container">
                                <form id="contact-form" action="#" method="post">
                                    <input type="number" name="name" placeholder="Teachers *">
                                    <input type="number" name="teachers" placeholder="Classes *">
                                    <input type="number" name="students" placeholder="Students *">
                                    <button type="submit" class="button-default button-yellow submit w-100"><i
                                            class="fa fa-save"></i>Save</button>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
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
                            <h3>Our Services</h3>
                            <p>Our best services for your kids</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="single-service-item-wrapper">
                        <div class="single-service-item">
                            <div class="single-service-text">
                                <h4>Meals Provided</h4>
                                <p>Serving nutritious, balanced meals to keep our students healthy and energized for
                                    learning.</p>
                            </div>
                            <div class="single-service-icon">
                                <i class="fa fa-cutlery"></i>
                            </div>
                        </div>
                        <div class="single-service-item">
                            <div class="single-service-text">
                                <h4>Swimming Lessons</h4>
                                <p>Building confidence, safety skills, and promoting physical fitness through regular
                                    swimming sessions.</p>
                            </div>
                            <div class="single-service-icon">
                                <i class="fa fa-anchor"></i>
                            </div>
                        </div>
                        <div class="single-service-item">
                            <div class="single-service-text">
                                <h4>Transport Available</h4>
                                <p>Ensuring safe and reliable pick-up and drop-off for students, providing peace of mind
                                    to parents.</p>
                            </div>
                            <div class="single-service-icon">
                                <i class="fa fa-bus"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="service-image">
                        <img src="/img/banner/13.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="single-service-item-wrapper">
                        <div class="single-service-item">
                            <div class="single-service-icon">
                                <i class="fa fa-calendar-check-o"></i>
                            </div>
                            <div class="single-service-text">
                                <h4>School Trips</h4>
                                <p>Offering exciting trips that broaden horizons and provide practical learning
                                    experiences.</p>
                            </div>
                        </div>
                        <div class="single-service-item">
                            <div class="single-service-icon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <div class="single-service-text">
                                <h4>Computer Lessons</h4>
                                <p>Equipping students with essential computer skills to thrive in today’s digital world.
                                </p>
                            </div>
                        </div>
                        <div class="single-service-item">
                            <div class="single-service-icon">
                                <i class="fa fa-music"></i>
                            </div>
                            <div class="single-service-text">
                                <h4>Music Lessons</h4>
                                <p>Cultivating creativity and self-expression through engaging music lessons.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Service Area-->

    <!--Google Map Area Start -->
    <div class="google-map-area">
        <!--  Map Section -->
        <div id="contacts" class="map-area">
            <div id="googleMap" style="width:100%;height:451px;"></div>
        </div>
    </div>
    <!--End of Google Map Area-->
    {{-- BODY ENDS HERE --}}
    <script src="/resources/js/homepage.js"></script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
