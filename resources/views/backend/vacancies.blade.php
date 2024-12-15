<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Edit - Chantilly Schools About Us" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_vacancy" />

    {{-- BODY STARTS HERE --}}
    @php
        function convertToEmbedLink($youtubeUrl) {
            // Parse the URL to extract query parameters
            $parsedUrl = parse_url($youtubeUrl);
            parse_str($parsedUrl['query'], $queryParams);

            // Check if the URL contains a video ID
            if (isset($queryParams['v'])) {
                $videoId = $queryParams['v'];
                return "https://www.youtube.com/embed/" . $videoId;
            }

            // Handle short links (e.g., youtu.be)
            if (strpos($parsedUrl['host'], 'youtu.be') !== false) {
                $videoId = trim($parsedUrl['path'], '/');
                return "https://www.youtube.com/embed/" . $videoId;
            }

            // Return original URL if it's not a valid YouTube link
            return $youtubeUrl;
        }
    @endphp
    
    <!--Class List Area Start-->
    <div class="class-list-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 my-2">
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
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVacancies"><i class="fa fa-plus"></i> Post Vacancies</button>

                    {{-- add a new vacancy --}}
                    <div class="modal fade bd-example-modal-lg" id="addVacancies" tabindex="-1" aria-labelledby="AddGalleryPhoto" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="AddGalleryPhoto"><u>Register Vacancy</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="addVacancyForm" action="/Vacancies/Edit/addVacancy" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-1">
                                                <label for="vacancy_title"><b>Vacancy Title</b></label>
                                                <input type="text" name="vacancy_title" id="vacancy_title" required placeholder="Vacancy Title">
                                            </div>
                                            <div class="mb-1">
                                                <label for="vacancy_deadline"><b>Vacancy Deadline</b></label>
                                                <input type="date" name="vacancy_deadline" id="vacancy_deadline" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="nature_n_scope"><b>Nature & Scope</b></label>
                                                <input type="hidden" id="nature_n_scope_save" name="nature_n_scope" value="">
                                                <textarea class="vacancy_descriptions" id="nature_n_scope" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <label for="qualifications"><b>Qualifications</b></label>
                                                <input type="hidden" id="qualifications_save" name="qualifications" value="">
                                                <textarea class="vacancy_descriptions" id="qualifications" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <label for="vacancy_status">Vacancy Status</label>
                                                <select name="vacancy_status" id="vacancy_status" required>
                                                    <option value="" hidden>Select Status</option>
                                                    <option value="1" >Public</option>
                                                    <option value="0" >Private</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Register Vacancy</button>
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

                    {{-- delete confirmatiom --}}
                    <div class="modal fade" id="deleteVacancyWindow" tabindex="-1" aria-labelledby="deleteVacancy" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteVacancy">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this vacancy? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" class="btn btn-sm btn-info" id="confirm_delete_vacancy"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit vacancy --}}
                    <div class="modal fade bd-example-modal-lg" id="editVacancies" tabindex="-1" aria-labelledby="AddGalleryPhoto" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="AddGalleryPhoto"><u>Edit Vacancy</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="editVacancyForm" action="/Vacancies/Edit/updateVacancy" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-1">
                                                <label for="edit_vacancy_title"><b>Vacancy Title</b></label>
                                                <input type="hidden" name="edit_vacancy_id" id="edit_vacancy_id">
                                                <input type="text" name="edit_vacancy_title" id="edit_vacancy_title" required placeholder="Vacancy Title">
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_vacancy_deadline"><b>Vacancy Deadline</b></label>
                                                <input type="date" name="edit_vacancy_deadline" id="edit_vacancy_deadline" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_nature_n_scope"><b>Nature & Scope</b></label>
                                                <input type="hidden" id="edit_nature_n_scope_save" name="edit_nature_n_scope" value="">
                                                <textarea class="vacancy_descriptions" id="edit_nature_n_scope" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_qualifications"><b>Qualifications</b></label>
                                                <input type="hidden" id="edit_qualifications_save" name="edit_qualifications" value="">
                                                <textarea class="vacancy_descriptions" id="edit_qualifications" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_vacancy_status">Vacancy Status</label>
                                                <select name="edit_vacancy_status" id="edit_vacancy_status" required>
                                                    <option value="" hidden>Select Status</option>
                                                    <option value="1" >Public</option>
                                                    <option value="0" >Private</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Update</button>
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
                <div class="col-xl-12 col-lg-12">
                    @if (count($vacancies) > 0)
                        @foreach ($vacancies as $item)
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{ucwords(strtolower($item->vacancy_title))}}</a></h3>
                                            <input type="hidden" name="" value="{{json_encode($item)}}" id="vacancy_details_{{$item->vacancy_id}}">
                                            <div class="class-information">
                                                <span>Deadline: {{date("l, dS M Y", strtotime($item->deadline))}}</span>
                                            </div>
                                            <p>
                                                <h6>Nature & Scope</h6>
                                                {!!$item->nature_scope!!}
                                            </p>
                                            <button class="btn btn-sm btn-outline-primary rounded edit_vacancies" id="edit_vacancies_{{$item->vacancy_id}}" data-bs-toggle="modal" data-bs-target="#editVacancies"><i class="fa fa-pencil"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-info rounded delete_vacancies" id="delete_vacancies_{{$item->vacancy_id}}" data-bs-toggle="modal" data-bs-target="#deleteVacancyWindow"><i class="fa fa-trash"></i> Delete</button>
                                            <a href="/Vacancies/Edit/changeStatus/{{$item->vacancy_id}}" class="btn btn-sm {{$item->display == "1" ? "btn-primary" : "btn-warning"}}"><i class="fa {{$item->display == "1" ? "fa-eye" : "fa-eye-slash"}}"></i> {{$item->display == "1" ? "visible" : "hidden"}}</a>
                                            <a href="/Vacancies/View/{{$item->vacancy_id}}/Applications" class="btn btn-sm btn-secondary"><i class="fa fa-paper-plane-o"></i> View Applications</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No vacancies present at the moment!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End of Class List Area-->

    <!--Google Map Area Start -->
    <div class="google-map-area">
        <!--  Map Section -->
        <div id="contacts" class="map-area">
            <div id="googleMap" style="width:100%;height:451px;"></div>
        </div>
    </div>
    <!--End of Google Map Area-->
    {{-- BODY ENDS HERE --}}
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/if2hs0ax6hmgx2842yuozz7qt8lde0hvc8upqv9gmokdk2id/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

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
            selector: '.vacancy_descriptions',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(aboutUsHistory);
                });
            }
        });
        
        window.addEventListener("load", function () {
            // edit awards
            var group_editor = document.getElementsByClassName("group_editor");
            for (let index = 0; index < group_editor.length; index++) {
                const element = group_editor[index];
                element.addEventListener("click", function () {
                    var value = cObj("group_data_"+this.id.substr(13)).value;
                    if (hasJsonStructure(value)) {
                        var group_data = JSON.parse(value);
                        cObj("edit_gallery_group_name").value = group_data.group_name;
                        cObj("edit_group_id").value = group_data.group_id;
                    }
                });
            }

            var group_deletor = document.getElementsByClassName("group_deletor");
            for (let index = 0; index < group_deletor.length; index++) {
                const element = group_deletor[index];
                element.addEventListener("click", function () {
                    cObj("confirm_delete_group").href = "/Gallery/Edit/deleteGroupName/"+element.id.substr(14);
                })
            }

            var edit_gallery_photo = document.getElementsByClassName("edit_gallery_photo");
            for (let index = 0; index < edit_gallery_photo.length; index++) {
                const element = edit_gallery_photo[index];
                element.addEventListener("click", function () {
                    var photo_data = cObj("photo_details_"+this.id.substr(19)).value;
                    if (hasJsonStructure(photo_data)) {
                        var decode_phone_data = JSON.parse(photo_data);
                        cObj("download_gallery_photo").href = decode_phone_data.image_path;
                        cObj("view_gallery_photo").src = decode_phone_data.image_path;
                        cObj("gallery_photo_id").value = decode_phone_data.img_id;

                        var group_options = cObj("edit_photo_gallery_group").children;
                        for (let index = 0; index < group_options.length; index++) {
                            const element = group_options[index];
                            if (element.value == decode_phone_data.gallery_group_id) {
                                element.selected = true;
                            }
                        }
                    }
                })
            }

            var delete_gallery_photo = document.getElementsByClassName("delete_gallery_photo");
            for (let index = 0; index < delete_gallery_photo.length; index++) {
                const element = delete_gallery_photo[index];
                element.addEventListener("click", function () {
                    cObj("confirm_delete_gallery_photo").href = "/Gallery/Edit/deletePhoto/"+ this.id.substr(21);
                });
            }

            cObj("addVacancyForm").addEventListener("submit", function () {
                var vacancy_descriptions = document.getElementsByClassName("vacancy_descriptions");
                for (let index = 0; index < vacancy_descriptions.length; index++) {
                    const element = vacancy_descriptions[index];
                    const content = tinymce.get(element.id).getContent();
                    document.getElementById(element.id+'_save').value = content;
                }
            });

            cObj("editVacancyForm").addEventListener("submit", function () {
                var vacancy_descriptions = document.getElementsByClassName("vacancy_descriptions");
                for (let index = 0; index < vacancy_descriptions.length; index++) {
                    const element = vacancy_descriptions[index];
                    const content = tinymce.get(element.id).getContent();
                    document.getElementById(element.id+'_save').value = content;
                }
            });

            // load vacancy details
            var edit_vacancies = document.getElementsByClassName("edit_vacancies");
            for (let index = 0; index < edit_vacancies.length; index++) {
                const element = edit_vacancies[index];
                element.addEventListener("click",  function () {
                    var element_data = cObj("vacancy_details_"+element.id.substr(15)).value;
                    if (hasJsonStructure(element_data)) {
                        var decoded_data = JSON.parse(element_data);

                        // fill the data 
                        cObj("edit_vacancy_title").value = decoded_data.vacancy_title;
                        cObj("edit_vacancy_deadline").value = decoded_data.deadline;
                        cObj("edit_vacancy_id").value = decoded_data.vacancy_id;
                        tinymce.get("edit_nature_n_scope").setContent(decoded_data.nature_scope);
                        tinymce.get("edit_qualifications").setContent(decoded_data.vacancy_qualifications);
                        var children = cObj("edit_vacancy_status").children;
                        for (let index = 0; index < children.length; index++) {
                            const element = children[index];
                            if (element.value == decoded_data.display) {
                                element.selected = true;
                            }
                        }
                    }
                });
            }

            var delete_vacancies = document.getElementsByClassName("delete_vacancies");
            for (let index = 0; index < delete_vacancies.length; index++) {
                const element = delete_vacancies[index];
                element.addEventListener("click", function () {
                    cObj("confirm_delete_vacancy").href = "/Vacancies/Edit/deleteVacancy/"+this.id.substr(17);
                });
            }
        });

    </script>
    <script src="/resources/js/homepage.js"></script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
