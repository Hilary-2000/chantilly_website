<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Vacancies - Chantilly Schools" />

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/ggolbjoxo01ftm9unfchjauk9agcbnvzc5460djiq9vu2axp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_vacancy" />

    {{-- BODY STARTS HERE --}}
    <!--Contact Area Strat-->
    <div class="contact-area section-padding">
        <div class="container">
            <a href="/Vacancies/View/{{$applicant_data->vacancy_id}}/Applications" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> back to applicants</a>
            <div class="single-title text-center">
                <h3>Application for : "{{$applicant_data->vacancy_title}}"</h3>
                @if ($errors->any())
                    <div class="alert alert-info">
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
                    <div class="alert alert-info py-1 text-center my-1">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="single-title">
                            <h3>Application details</h3>
                        </div>
                        <div class="contact-form-container">
                            <label for="fullname">Applicant Fullname</label>
                            <input disabled type="text" value="{{$applicant_data->fullname}}" name="fullname" placeholder="Applicant Fullname *" required>
                            <label for="email">Applicant Email</label>
                            <input type="email" name="email" value="{{$applicant_data->email}}" disabled placeholder="Applicant Email *" required>
                            <label for="phonenumber">Applicant Phone Number</label>
                            <input type="text" name="phonenumber" value="{{$applicant_data->phone}}" disabled placeholder="Applicant Phone Number *" required>
                            <label for="marital_status">Marital Status</label>
                            <input type="text" value="{{$applicant_data->marital_status}}" disabled>
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="text" value="{{date("D dS M Y", strtotime($applicant_data->DOB))}}" disabled>
                            <label for="">Applicant CV</label>
                            <a class="{{$applicant_data->cv_location ? "" : "d-none"}}" href="{{$applicant_data->cv_location}}" id="download_gallery_photo" download="">
                                <i class="fa fa-download text-success"> Download Applicant CV</i>
                            </a>
                            <p class="{{$applicant_data->cv_location ? "d-none" : ""}}">Applicant didn`t upload the CV!</p>
                            <br><br>
                            <label for="yourmessage">About the Applicant</label>
                            <textarea name="your_message" class="yourmessage" id="your_message" placeholder="Applicant message"></textarea>
                            <input type="hidden" name="about_yourself" id="about_yourself">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-area-container">
                        <div class="single-title">
                            <h3>Job Description</h3>
                        </div>
                        <div class="contact-address-container">
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Nature & Scope</h4>
                                    <span>{!!$applicant_data->nature_scope!!}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Qualification</h4>
                                    <span>
                                        {!!$applicant_data->vacancy_qualifications!!}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Contact Area-->
    {{-- BODY ENDS HERE --}}
    <script>
        var applicant_data = @json($applicant_data->summary_about_you ?? "");
        // init tinymce
        tinymce.init({
            selector: '#your_message',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(applicant_data);
                });
            }
        });
    </script>
    {{-- FOOTER --}}
    <x-footer page="vacancies"/>
</body>

</html>
