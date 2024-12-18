<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Edit - Chantilly Schools About Us" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_extra_curricular" />

    {{-- BODY STARTS HERE --}}
    @php
        function convertToEmbedLink($youtubeUrl)
        {
            // Parse the URL to extract query parameters
            $parsedUrl = parse_url($youtubeUrl);
            parse_str($parsedUrl['query'], $queryParams);

            // Check if the URL contains a video ID
            if (isset($queryParams['v'])) {
                $videoId = $queryParams['v'];
                return 'https://www.youtube.com/embed/' . $videoId;
            }

            // Handle short links (e.g., youtu.be)
            if (strpos($parsedUrl['host'], 'youtu.be') !== false) {
                $videoId = trim($parsedUrl['path'], '/');
                return 'https://www.youtube.com/embed/' . $videoId;
            }

            // Return original URL if it's not a valid YouTube link
            return $youtubeUrl;
        }
    @endphp

    <!--About Area Start-->
    <div class="about-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary my-4" data-bs-toggle="modal" data-bs-target="#addNewEvent"><i
                            class="fa fa-plus"></i> Add Extra-Curriculum</button>
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

                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-lg" id="addNewEvent" tabindex="-1"
                        aria-labelledby="contactFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="contactFormModalLabel"><u> Add Extra-Curriculum!</u>
                                    </h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/ExtraCurriculum/Edit/add" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-1">
                                                <label for="extra_curricullum_title">Extra-Curriculum title</label>
                                                <input type="text" name="extra_curricullum_title"
                                                    id="extra_curricullum_title"
                                                    placeholder="Extra-Curriculum : Swimming" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="extra_curriculum_image">Event image</label>
                                                <input type="file" name="extra_curriculum_image"
                                                    id="extra_curriculum_image" accept=".jpg, .jpeg, .png, .gif"
                                                    placeholder="Event image" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="extra_curriculum_description">Extra-Curriculum
                                                    description</label>
                                                <textarea id="extra_curriculum_description" name="extra_curriculum_description"
                                                    placeholder="Extra-Curriculum description.."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i
                                                    class="fa fa-save"></i> Save Event</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DELETE CONFIRMATION --}}
                    <div class="modal fade" id="deleteCurriculumModal" tabindex="-1"
                        aria-labelledby="deleteCurriculumModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteCurriculumModal">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-sm btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                        <a href="#" class="btn btn-sm btn-info" id="confirmDelete"><i
                                                class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-lg" id="editCurriculum" tabindex="-1"
                        aria-labelledby="editAnEvent" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editAnEvent"><u>Edit Event!</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/ExtraCurriculum/Edit/update" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-1">
                                                <input type="hidden" name="edit_extra_curricullum_id"
                                                    id="edit_extra_curricullum_id">
                                                <label for="extra_curricullum_title">Extra-Curriculum title</label>
                                                <input type="text" name="edit_extra_curricullum_title"
                                                    id="edit_extra_curricullum_title"
                                                    placeholder="Extra-Curriculum : Swimming" required>
                                            </div>
                                            <div class="mb-1">
                                                <a href="/web-data/20241210184413.jpg"
                                                    id="download_extracurricular_img" download="">
                                                    <i class="fa fa-download text-success"> Download Image</i>
                                                </a><br>
                                                <img id="view_extracurricular_img" class="mb-2" width="100"
                                                    height="100" src="/web-data/20241210184413.jpg"><br>
                                                <label for="extra_curriculum_image">Event image</label>
                                                <input type="file" name="edit_extra_curriculum_image"
                                                    id="edit_extra_curriculum_image" accept=".jpg, .jpeg, .png, .gif"
                                                    placeholder="Event image">
                                            </div>
                                            <div class="mb-1">
                                                <label for="extra_curriculum_description">Extra-Curriculum
                                                    description</label>
                                                <textarea id="edit_extra_curriculum_description" name="edit_extra_curriculum_description"
                                                    placeholder="Extra-Curriculum description.."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i
                                                    class="fa fa-save"></i> Save Event</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- LIVE EVENTS --}}
        <div class="container w-100">
            <div class="row">
                @if (count($curricullum) > 0)
                    @foreach ($curricullum as $item)
                        <div class="col-lg-4 my-2">
                            <div class="single-class">
                                <div class="single-class-image">
                                    <input type="hidden" name=""
                                        id="extra_curriculum_data_{{ $item->extra_curriculum_id }}"
                                        value="{{ json_encode($item) }}">
                                    <a href="#!" class="extra_curriculum"
                                        id="extra_curriculum_{{ $item->extra_curriculum_id }}" data-bs-toggle="modal"
                                        data-bs-target="#editCurriculum">
                                        <img src="{{ $item->extra_curriculum_image }}" alt="">
                                        <span class="class-date"><i class="fa fa-pencil"></i> <span>edit</span></span>
                                    </a>
                                </div>
                                <div class="single-class-text">
                                    <div class="class-des">
                                        <h4><a href="#">{{ $item->extra_curriculum_title }}</a></h4>
                                        <p>{{ $item->extra_curriculum_description }}</p>
                                    </div>
                                    <div class="container my-2 w-100">
                                        <a class="btn btn-sm {{ $item->display == 1 ? 'btn-primary' : 'btn-warning' }}"
                                            href="/ExtraCurriculum/Edit/change_status/{{ $item->extra_curriculum_id }}"><i
                                                class="fa {{ $item->display == 1 ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                            {{ $item->display == 1 ? 'visible' : 'hidden' }}</a>
                                        <button class="btn btn-sm btn-info delete_ex"
                                            id="delete_ex_{{ $item->extra_curriculum_id }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteCurriculumModal"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="class-list-item">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-secondary">No ExtraCurricular at the moment!</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        {{-- LIVE EVENTS --}}
    </div>
    <!--End of About Area-->

    {{-- BODY ENDS HERE --}}

    <!-- Place the following <script>
        and < textarea > tags your HTML 's <body> --> 
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

        window.addEventListener("load", function() {
            var extra_curriculum = document.getElementsByClassName("extra_curriculum");
            for (let index = 0; index < extra_curriculum.length; index++) {
                const element = extra_curriculum[index];
                element.addEventListener("click", function() {
                    var extra_curriculum_data = cObj("extra_curriculum_data_" + element.id.substr(17))
                    .value;
                    if (hasJsonStructure(extra_curriculum_data)) {
                        var decoded_data = JSON.parse(extra_curriculum_data);
                        cObj("edit_extra_curricullum_title").value = decoded_data.extra_curriculum_title;
                        cObj("edit_extra_curriculum_description").value = decoded_data
                            .extra_curriculum_description;
                        cObj("view_extracurricular_img").src = decoded_data.extra_curriculum_image;
                        cObj("download_extracurricular_img").href = decoded_data.extra_curriculum_image;
                        cObj("edit_extra_curricullum_id").value = decoded_data.extra_curriculum_id;
                    }
                });
            }

            var delete_ex = document.getElementsByClassName("delete_ex");
            for (let index = 0; index < delete_ex.length; index++) {
                const element = delete_ex[index];
                element.addEventListener("click", function() {
                    cObj("confirmDelete").href = "/ExtraCurriculum/Edit/delete/" + element.id.substr(10);
                });
            }

        });
    </script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
