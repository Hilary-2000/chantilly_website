<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-edit-header title="Edit - Chantilly Schools About Us" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_aboutus" />

    {{-- BODY STARTS HERE --}}

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
                <div class="col-md-12">
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

                    <!-- Modal Structure for history image-->
                    <div class="modal fade bd-example-modal-sm" id="editHistoryImage" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="contactFormModalLabel">Edit History Image</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/AboutUs/Edit/uploadImage" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <label for="historyImageValue" class="form-control-label"><b>History Image</b></label>
                                            <input type="file" class="form-control-input" name="historyImageValue" accept=".jpg, .jpeg, .png, .gif" required>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Update Image</button>
                                        </form>
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
                <div class="col-md-12">
                    <div class="container mb-5">
                        <div class="collapse collapsible-window mt-3" id="editWindow">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5 class="my-2">Edit History</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-close" data-bs-toggle="collapse" data-bs-target="#editWindow"></button>
                                    </div>
                                </div>
                                <form id="contact-form" action="/AboutUs/Edit/manage" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="openEditorData" name="content" required>
                                    <div class="mb-3">
                                        <textarea id="about_us_editor" class="form-control" placeholder="Brief history about Chantilly School.."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Save History</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-sm btn-primary mb-5"  data-bs-toggle="collapse" data-bs-target="#editWindow" ><i class="fa fa-pencil"></i> Edit History</button>
                    <div class="about-text-container">
                        {!! $history !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-sm btn-secondary mb-5" data-bs-toggle="modal" data-bs-target="#editHistoryImage"><i class="fa fa-pencil"></i> Edit Image</button>
                    <div class="skill-image my-auto">
                        <img src="{{$history_image != null ? $history_image : "/img/class/chantillyadmin.jpg"}}" alt="">
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
                    <!-- Modal Structure for awards-->
                    <div class="modal fade bd-example-modal-lg" id="addAwardWindow" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="contactFormModalLabel">Add an Award</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/AboutUs/Edit/addAward" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <label for="award_title" class="form-control-label">Award Title</label>
                                            <input type="text" name="award_title" placeholder="Award Title" required>
                                            <label for="date_of_award" class="form-control-label">Award Date</label>
                                            <input type="date" name="date_of_award" placeholder="Award Date" required>
                                            <label for="award_image" class="form-control-label">Award Image</label>
                                            <input type="file" name="award_image" placeholder="Award Image"  accept=".jpg, .jpeg, .png, .gif" required>
                                            <label for="award_description" class="form-control-label">Award Image</label>
                                            <textarea name="award_description" cols="30" rows="5" placeholder="Enter award description!" required></textarea>
                                            <button type="submit" class="btn btn-success btn-sm w-100"><i class="fa fa-save"></i> Add</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="deleteCurriculumModalID" tabindex="-1" aria-labelledby="deleteCurriculumModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteCurriculumModal">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" class="btn btn-sm btn-info" id="confirmDeleteCurricullum"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Structure for awards-->
                    <div class="modal fade bd-example-modal-lg" id="editAwardWindow" tabindex="-1" aria-labelledby="editAwardModel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editAwardModel">Edit Award</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button class="btn btn-sm btn-outline-info" id="delete_award_btn" data-bs-toggle="modal" data-bs-target="#deleteCurriculumModalID"><i class="fa fa-trash"></i> Delete</button>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" id="about_us_visibility" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> visible</a>
                                        </div>
                                    </div>
                                    <div class="contact-form-container">
                                        <form action="/AboutUs/Edit/editAward" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input required type="hidden" name="edit_award_id" id="edit_award_id">
                                            <label for="edit_award_title" class="form-control-label">Award Title</label>
                                            <input required type="text" id="edit_award_title" name="edit_award_title" placeholder="Award Title">
                                            <label for="edit_date_of_award" class="form-control-label">Award Date</label>
                                            <input required type="date" id="edit_date_of_award" name="edit_date_of_award" placeholder="Award Date">
                                            <label for="edit_award_image" class="form-control-label">Award Image</label><br>
                                            <a href="path/to/your-file.pdf" id="award_image_link" download>
                                                <i class="fa fa-download text-success"> Download Image</i>
                                            </a><br>
                                            <img id="edit_curricullum_image" width="100" height="100">
                                            <input type="file" id="edit_award_image" name="edit_award_image" accept=".jpg, .jpeg, .png, .gif" placeholder="Award Image">
                                            <label for="edit_award_description" class="form-control-label">Award Image</label>
                                            <textarea required id="edit_award_description" name="edit_award_description" cols="30" rows="5" placeholder="Enter award description!"></textarea>
                                            <button type="submit" class="btn btn-success btn-sm w-100"><i class="fa fa-save"></i> Edit</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" id="close_edit_award_window" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-title-wrapper">
                        <div class="section-title" id="our_awards">
                            <h3>Our Awards</h3>
                            <p>We are glad to showcase our awards a true testament of our prowess.</p>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm mb-5"  data-bs-toggle="modal" data-bs-target="#addAwardWindow"><i class="fa fa-plus"></i> Add Awards</button>
                </div>
            </div>
            <div class="teachers-column-carousel carousel-style-one owl-carousel">
                @if (count($awards) > 0)
                    @foreach ($awards as $award)
                        <div class="single-teachers-column text-center">
                            <div class="teachers-image-column">
                                <input type="hidden" value="{{json_encode($award)}}" id="award_value_{{$award->award_id}}">
                                <a href="#!" class="edit_award_btn" id="edit_award_but_{{$award->award_id}}" data-bs-toggle="modal" data-bs-target="#editAwardWindow">
                                    <img src="{{$award->award_image}}" alt="">
                                    <span class="image-hover" id="edit_award_btn_{{$award->award_id}}" >
                                        <span><i class="fa fa-pencil"></i> Edit</span>
                                    </span>
                                </a>
                            </div>
                            <div class="teacher-column-carousel-text">
                                <h4>{{$award->award_title}}</h4>
                                <span>{{date("dS M Y", strtotime($award->award_date))}}</span>
                                <p>{{$award->award_description}}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container">
                        <p class="text-center"><i class="fa fa-error"></i> No Awards at the moment!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--End of Teachers Column Carousel-->
    {{-- BODY ENDS HERE --}}
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/ggolbjoxo01ftm9unfchjauk9agcbnvzc5460djiq9vu2axp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
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

        var aboutUsHistory = @json($history ?? '');

        // init tinymce
        tinymce.init({
            selector: '#about_us_editor',
            plugins: 'anchor autolink link lists searchreplace table wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link | align lineheight | numlist bullist indent outdent | removeformat',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(aboutUsHistory);
                });
            }
        });

        // Synchronize TinyMCE content on form submission
        document.querySelector('#contact-form').addEventListener('submit', function (event) {
            const content = tinymce.get('about_us_editor').getContent(); // Correct usage of the TinyMCE editor ID
            document.getElementById('openEditorData').value = content;

            // preventDefault
            // event.preventDefault(); // Properly prevent the form submission
        });
        
        window.addEventListener("load", function () {
            // edit awards
            var awardsEditor = document.getElementsByClassName("edit_award_btn");
            for (let index = 0; index < awardsEditor.length; index++) {
                const element = awardsEditor[index];
                element.addEventListener("click", function () {
                    var award_value = document.getElementById("award_value_"+element.id.substr(15)).value;
                    if (hasJsonStructure(award_value)) {
                        // our_awards
                        var our_awards = JSON.parse(award_value);
                        
                        // set the awards
                        cObj("edit_award_id").value = our_awards['award_id'];
                        cObj("edit_award_title").value = our_awards['award_title'];
                        cObj("edit_date_of_award").value = our_awards['award_date'];
                        cObj("award_image_link").href = our_awards['award_image'];
                        cObj("edit_curricullum_image").src = our_awards['award_image'];
                        cObj("edit_award_description").value = our_awards['award_description'];
                        cObj("confirmDeleteCurricullum").href = "/AboutUs/Edit/deleteAward/"+our_awards['award_id'];
                        cObj("about_us_visibility").href = "/AboutUs/Edit/changeDisplay/"+our_awards['award_id'];
                        
                        // ABOUT US VISIBILITY
                        cObj("about_us_visibility").innerHTML = our_awards['award_display'] == "1" ? '<i class="fa fa-eye"></i> visible' : '<i class="fa fa-eye-slash"></i> hidden';
                        if (our_awards['award_display'] == "1") {
                            cObj("about_us_visibility").classList.remove("btn-warning");
                            cObj("about_us_visibility").classList.add("btn-primary");
                        }else{
                            cObj("about_us_visibility").classList.add("btn-warning");
                            cObj("about_us_visibility").classList.remove("btn-primary");
                        }
                    }
                });
            }
            
            cObj("delete_award_btn").addEventListener("click", function () {
                cObj("close_edit_award_window").click();
            });

        });

    </script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
