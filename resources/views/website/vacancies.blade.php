<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Vacancies - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="vacancy" />

    {{-- BODY STARTS HERE --}}

    <!--Breadcrumb Banner Area Start-->
    <div class="breadcrumb-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-text">
                        <h1 class="text-center">Vacancies</h1>
                        <div class="breadcrumb-bar">
                            <ul class="breadcrumb">
                                <li><a href="/">Home</a></li>
                                <li>Vacancies</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Breadcrumb Banner Area-->
    
    <!--Class List Area Start-->
    <div class="class-list-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-lg" id="jobDescription" tabindex="-1" aria-labelledby="AddGalleryPhoto" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="job_title">Confirm Deletion</h4>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-area-container">
                                        <div class="single-title">
                                            <h6>Job Description</h6>
                                        </div>
                                        <div class="contact-address-container">
                                            <div class="contact-address-info">
                                                <div class="contact-icon">
                                                    <i class="fa fa-certificate"></i>
                                                </div>
                                                <div class="contact-text">
                                                    <h4>Nature & Scope</h4>
                                                    <span id="nature_n_scope"></span>
                                                </div>
                                            </div>
                                            <div class="contact-address-info">
                                                <div class="contact-icon">
                                                    <i class="fa fa-certificate"></i>
                                                </div>
                                                <div class="contact-text">
                                                    <h4>Qualification</h4>
                                                    <span id="qualification"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                    @if (count($vacancies) > 0)
                        @foreach ($vacancies as $key => $vacancy)
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="class-list-text">
                                            <input type="hidden" id="vacancy_data_{{$vacancy->vacancy_id}}" value="{{json_encode($vacancy)}}">
                                            <h3><a href="#">{{$vacancy->vacancy_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Deadline: {{date("l dS M Y", strtotime($vacancy->deadline))}}</span>
                                            </div>
                                            <p>
                                                <h6>Nature & Scope</h6>
                                                {!!$vacancy->nature_scope!!}
                                            </p>
                                            <a href="/Vacancies/Apply/{{$vacancy->vacancy_id}}" class="button-default">Apply Now <i class="fa fa-angle-right"></i></a>
                                            <a href="#!" class="button-default job_description_btn" id="job_description_{{$vacancy->vacancy_id}}" data-bs-toggle="modal" data-bs-target="#jobDescription">Job Description <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-danger text-center" style="font-size: 60px;"><i class="fa fa-exclamation-triangle"></i></p>
                        <p class="text-center text-danger">No vacancies present at the moment!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End of Class List Area-->
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

        window.onload = function () {
            var job_description_btn = document.getElementsByClassName("job_description_btn");
            for (let index = 0; index < job_description_btn.length; index++) {
                const element = job_description_btn[index];
                element.addEventListener("click", function () {
                    var vacancy_data = cObj("vacancy_data_"+element.id.substr(16)).value;
                    if (hasJsonStructure(vacancy_data)) {
                        var json_data = JSON.parse(vacancy_data);
                        cObj("job_title").innerHTML = json_data.vacancy_title;
                        cObj("nature_n_scope").innerHTML = json_data.nature_scope;
                        cObj("qualification").innerHTML = json_data.vacancy_qualifications;
                    }
                });
            }
        }
    </script>

    {{-- FOOTER --}}
    <x-footer page="vacancies"/>
</body>

</html>
