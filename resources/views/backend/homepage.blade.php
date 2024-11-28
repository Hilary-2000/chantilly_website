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
                
                <!-- Modal Structure for carrousels-->
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

                <!-- Delete Confirmation Modal for carrousels-->
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
    <div class="class-area section-padding" id="edit_curricullum">
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
                <div class="col-md-4 mb-4">
                    <button class="btn btn-secondary btn-sm"  data-bs-toggle="modal" data-bs-target="#addCurricullumFormID"><i class="fa fa-plus"></i> Add Curricullum</button>

                    {{-- MODAL STRUCTURE FOR THE CURRICULUMS --}}
                    <div class="modal fade" id="addCurricullumFormID" tabindex="-1" aria-labelledby="addCurricullumForm" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="addCurricullumForm">Add Curricullum</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="contact-form" action="/Homepage/saveCurricullum" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="curriculum_title" class="form-control-label">Curriculum Level</label>
                                                <input type="text" name="curriculum_title" placeholder="Level Name e.g, Pre-Primary *" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_age_range" class="form-control-label">Age range</label>
                                                <input type="text" name="curriculum_age_range" placeholder="Age range e.g, 2 - 6 Yrs *" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_classes" class="form-control-label">Number of classes</label>
                                                <input type="number" name="curriculum_classes" placeholder='Number of classes e.g: "3" - (for grade 4 - 6) *' required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_image" class="form-control-label">Curricullum Image</label>
                                                <input type="file" name="curriculum_image" placeholder="Curricullum Image *" accept=".jpg, .jpeg, .png, .gif" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_description" class="form-control-label">Curricullum Description</label>
                                                <textarea class="yourmessage" name="curriculum_description" placeholder="Your curricullum description!" required></textarea>
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

                    {{-- MODAL STRUCTURE FOR THE CURRICULUMS --}}
                    <div class="modal fade" id="editCurricullumFormID" tabindex="-1" aria-labelledby="editCurricullumForm" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editCurricullumForm">Edit Curricullum</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="contact-form" action="/Homepage/updateCurricullum" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="curriculum_title" class="form-control-label">Curricullum Title</label>
                                                <input type="hidden" name="curriculum_id" id="curriculum_id">
                                                <input type="text" id="curriculum_title" name="curriculum_title" placeholder="Level Name e.g, Pre-Primary *" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_age_range" class="form-control-label">Curricullum Age Range</label>
                                                <input type="text" id="curriculum_age_range" name="curriculum_age_range" placeholder="Age range e.g, 2 - 6 Yrs *" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_classes" class="form-control-label">Number of classes</label>
                                                <input type="number" id="curriculum_classes" name="curriculum_classes" placeholder='Number of classes e.g: "3" - (for grade 4 - 6) *' required>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-md-12">
                                                    <a href="path/to/your-file.pdf" id="download_curricullum_image" download>
                                                        <i class="fa fa-download text-success"> Download Image</i>
                                                    </a>
                                                    <div style="width: 100px; height: 100px;" >
                                                        <img src="" id="curricullum_image_thumbnail" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 w-100">
                                                    <input class="w-100" type="file" id="curriculum_image" name="curriculum_image" placeholder="Carrousel Title *" accept=".jpg, .jpeg, .png, .gif" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="curriculum_classes" class="form-control-label">Curricullum Description</label>
                                                <textarea class="yourmessage" id="curriculum_description" name="curriculum_description" placeholder="Your curricullum description!" required></textarea>
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

                    <!-- Delete Confirmation Modal for carrousels-->
                    <div class="modal fade" id="deleteCurriculumModalID" tabindex="-1" aria-labelledby="deleteCurriculumModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteCurriculumModal">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" class="btn btn-danger" id="confirmDeleteCurricullum"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-4">
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
                <div class="col-md-12 border border-primary rounded py-2">
                    @if (count($homepage_curriculum) > 0)
                        <div class="class-carousel carousel-style-one owl-carousel">
                            @foreach ($homepage_curriculum as $key => $item)
                                <div class="single-class">
                                    <div class="p-2 my-2">
                                        <button class="btn btn-sm btn-danger delete_curriculum" data-bs-toggle="modal" data-bs-target="#deleteCurriculumModalID" id="delete_curriculum_{{$item->curriculum_id}}"><i class="fa fa-trash"></i></button>
                                        <a href="/Homepage/displayCurricullum/{{$item->curriculum_id}}" class="btn btn-sm {{ $item->display == "1" ? "btn-primary" : "btn-warning"}}"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div class="single-class-image">
                                        <input type="hidden" value="{{json_encode($item)}}" id="edit_curriculum_data_{{$key}}" >
                                        <a href="#edit_curricullum" data-bs-toggle="modal" data-bs-target="#editCurricullumFormID">
                                            <img src="{{$item->curriculum_image}}" alt="">
                                            <span class="class-date curriculum_data" id="edit_curricullum_{{$key}}">Edit <span>Now</span></span>
                                        </a>
                                    </div>
                                    <div class="single-class-text">
                                        <div class="class-des">
                                            <h4><a href="#">{{$item->curriculum_title}}</a></h4>
                                            <p>{{$item->curriculum_description}}</p>
                                        </div>
                                        <div class="class-schedule">
                                            <span>AGE: {{$item->curriculum_age_range}} Yrs</span>
                                            <span>CLASSES : {{$item->curriculum_classes}}</span>
                                            <span class="arrow"><i class="fa fa-angle-right"></i></span>
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
                                                <h3><a class="text-secondary" href="#">No Curricullums present!</a></h3>
                                            </div>
                                        </div>
                                        <p>No Curricullums present at the moment.
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
    <!--End of Class Area-->

    <!--Fun Factor Area Start-->
    <div class="fun-factor-area" id="fun-factor-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="single-fun-factor">
                                <div class="fun-factor-icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <h2><span class="counter">{{$homepage_stats['teachers']}}</span></h2>
                                <span>Teachers</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="single-fun-factor">
                                <div class="fun-factor-icon">
                                    <i class="fa fa-bank"></i>
                                </div>
                                <h2><span class="counter">{{$homepage_stats['classes']}}</span></h2>
                                <span>Classes</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="single-fun-factor">
                                <div class="fun-factor-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <h2><span class="counter">{{$homepage_stats['students']}}</span></h2>
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
                                <form id="contact-form" action="/Homepage/updateStats/" method="post">
                                    @csrf
                                    <label for="teachers" class="form-control-label">Teachers Counts *</label>
                                    <input type="number" name="teachers" value="{{$homepage_stats['teachers']}}" placeholder="Teachers *">

                                    <label for="classes" class="form-control-label">Classes Count *</label>
                                    <input type="number" name="classes" value="{{$homepage_stats['classes']}}" placeholder="Classes *">

                                    <label for="students" class="form-control-label">Students Counts *</label>
                                    <input type="number" name="students" value="{{$homepage_stats['students']}}" placeholder="Students *">
                                    <button type="submit" class="button-default button-yellow submit w-100"><i class="fa fa-save"></i>Save</button>
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
