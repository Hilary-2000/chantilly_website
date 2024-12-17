<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Vacancies - Chantilly Schools" />

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/if2hs0ax6hmgx2842yuozz7qt8lde0hvc8upqv9gmokdk2id/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="vacancy"/>

    {{-- BODY STARTS HERE --}}
    <!--Contact Area Strat-->
    <div class="contact-area section-padding">
        <div class="container">
            <div class="single-title text-center">
                <h3>Apply for : "{{$vacancy_data[0]->vacancy_title}}"</h3>
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
                <div class="col-md-12">
                    <a href="/Vacancies" class="btn btn-sm btn-primary mb-3"><i class="fa fa-arrow-left"></i> Back to Vacancies</a>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="single-title">
                            <h3>Apply Here</h3>
                        </div>
                        <div class="contact-form-container">
                            <form id="contact-form" action="/Vacancies/apply" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="vacancy_id" value="{{$vacancy_data[0]->vacancy_id}}">
                                <label for="fullname">Your Fullname</label>
                                <input type="text" name="fullname" placeholder="Your Fullname *" required>
                                <label for="email">Your Email</label>
                                <input type="email" name="email" placeholder="Your Email *" required>
                                <label for="phonenumber">Your Phone Number</label>
                                <input type="text" name="phonenumber" placeholder="Your Phone Number *" required>
                                <label for="marital_status">Marital Status</label>
                                <select name="marital_status" required>
                                    <option value="" hidden>Marital Status *</option>
                                    <option value="married">Married</option>
                                    <option value="single">Single</option>
                                </select>
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" max="{{date("Y-m-d", strtotime("-18 years"))}}" name="date_of_birth" placeholder="Date of Birth *" required>
                                <label for="yourmessage">Date of Birth</label>
                                <textarea name="your_message" class="yourmessage" id="your_message" placeholder="Your message"></textarea>
                                <input type="hidden" name="about_yourself" id="about_yourself">
                                <label for="">Your CV</label>
                                <input type="file" accept=".pdf, .docx, .doc" name="your_cv" id="your_cv" required>
                                <button type="submit" class="button-default button-yellow submit"><i class="fa fa-send"></i>Submit</button>
                            </form>
                            <p class="form-messege"></p>
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
                                    <span>{!!$vacancy_data[0]->nature_scope!!}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Qualification</h4>
                                    <span>
                                        {!!$vacancy_data[0]->vacancy_qualifications!!}
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
        // init tinymce
        tinymce.init({
            selector: '#your_message',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            // setup: function (editor) {
            //     editor.on('init', function () {
            //         editor.setContent(aboutUsHistory);
            //     });
            // }
        });

        // Synchronize TinyMCE content on form submission
        document.querySelector('#contact-form').addEventListener('submit', function (event) {
            const content = tinymce.get('your_message').getContent(); // Correct usage of the TinyMCE editor ID
            document.getElementById('about_yourself').value = content;
        });
    </script>

    {{-- FOOTER --}}
    <x-footer page="vacancies"/>
</body>

</html>
