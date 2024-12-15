<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Edit - Chantilly Schools About Us" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_gallery" />

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

    <!--Gallery Area Start-->
    <div class="gallery-area section-padding gallery-full-width">
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
            </div>
            <div class="col-md-9">
                <div class="container w-100">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addGalleryPhoto"><i class="fa fa-plus"></i> Add Photo</button>
                    
                            <!-- Modal Structure for history value-->
                            <div class="modal fade bd-example-modal-sm" id="addGalleryPhoto" tabindex="-1" aria-labelledby="AddGalleryPhoto" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="AddGalleryPhoto"><u>Add Gallery Photo</u></h6>
                                            <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <div class="contact-form-container">
                                                <form action="/Gallery/Edit/addPhoto" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-1">
                                                        <label for="photo_name">Group Name</label>
                                                        <input type="file" name="photo_name" id="photo_name" required>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label for="photo_gallery_group">Gallery Group</label>
                                                        <select name="photo_gallery_group">
                                                            <option value="" hidden>Select an Option</option>
                                                            @foreach ($gallery_group as $item)
                                                                <option value="{{$item->group_id}}">{{$item->group_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Save Gallery Photo</button>
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

                            <!-- Modal Structure for history value-->
                            <div class="modal fade bd-example-modal-sm" id="editGalleryPhotoWin" tabindex="-1" aria-labelledby="editGalleryPhoto" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="editGalleryPhoto"><u>Edit Gallery Photo</u></h6>
                                            <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <div class="contact-form-container">
                                                <form action="/Gallery/Edit/updatePhoto" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-1">
                                                        <input type="hidden" name="gallery_photo_id" id="gallery_photo_id">
                                                        <a href="/web-data/20241207201418.jpg" id="download_gallery_photo" download="">
                                                            <i class="fa fa-download text-success"> Download Image</i>
                                                        </a><br>
                                                        <img id="view_gallery_photo" class="mb-2" width="100" height="100" src="/web-data/20241207201418.jpg">
                                                        <br>
                                                        <label for="edit_photo_name">Group Name</label>
                                                        <input type="file" name="edit_photo_name" id="edit_photo_name" required>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label for="edit_photo_gallery_group">Gallery Group</label>
                                                        <select name="edit_photo_gallery_group" id="edit_photo_gallery_group" required>
                                                            <option value="" hidden>Select an Option</option>
                                                            @foreach ($gallery_group as $item)
                                                                <option value="{{$item->group_id}}">{{$item->group_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Update Gallery Photo</button>
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

                            {{-- DELETE CONFIRMATION --}}
                            <div class="modal fade" id="deleteGalleryPhotoWin" tabindex="-1" aria-labelledby="deleteGalleryPhoto" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteGalleryPhoto">Confirm Deletion</h5>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this gallery group? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a href="#" class="btn btn-sm btn-info" id="confirm_delete_gallery_photo"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="filter-menu">
                                <ul>
                                    <li class="filter" data-filter="all">All</li>
                                    @foreach ($gallery_group as $item)
                                        <li class="filter" data-filter=".{{$item->group_id}}">{{$item->group_name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filter-items">
                        <div class="row">
                            @foreach ($gallery as $item)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mix single-items {{$item->gallery_group_id}} overlay-hover">
                                    <div class="overlay-effect">
                                        <a aria-disabled="true" tabindex="-1"><img src="{{$item->image_path}}" alt=""></a>
                                        <div class="gallery-hover-effect">
                                            <input type="hidden" value="{{json_encode($item)}}" id="photo_details_{{$item->img_id}}">
                                            <button class="btn btn-sm btn-outline-primary mt-2 edit_gallery_photo" id="edit_gallery_photo_{{$item->img_id}}" data-bs-toggle="modal" data-bs-target="#editGalleryPhotoWin"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-outline-info mt-2 delete_gallery_photo" id="delete_gallery_photo_{{$item->img_id}}" data-bs-toggle="modal" data-bs-target="#deleteGalleryPhotoWin"><i class="fa fa-trash"></i></button>
                                            <a class="btn btn-sm {{$item->image_status == "1" ? "btn-primary" : "btn-warning"}}  mt-2" href="/Gallery/Edit/changeDisplay/{{$item->img_id}}"><i class="fa {{$item->image_status == "1" ? "fa-eye" : "fa-eye-slash"}}"></i></a>
                                            <a class="gallery-icon venobox" href="{{$item->image_path}}"><i class="fa fa-image"></i></a>
                                            <span class="gallery-text">{{$item->group_name}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-widget-item res-mrg-top-xs">
                    <div class="single-title">
                        <h3>Gallery Groups</h3>
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addGalleryGroup"><i class="fa fa-plus"></i></button>
                    </div>
                    
                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-sm" id="addGalleryGroup" tabindex="-1" aria-labelledby="addGalleryGroups" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="addGalleryGroups"><u>Add Gallery Group</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/Gallery/Edit/addGroupName" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-1">
                                                <label for="gallery_group_name">Group Name</label>
                                                <input type="text" name="gallery_group_name" id="gallery_group_name" placeholder="Group Name : School Compound" required>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Add Gallery Group</button>
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
                    
                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-sm" id="updateGalleryGroup" tabindex="-1" aria-labelledby="editGalleryGroup" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editGalleryGroup"><u>Edit Gallery Group</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/Gallery/Edit/updateGroupName" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-1">
                                                <input type="hidden" name="edit_group_id" id="edit_group_id">
                                                <label for="edit_gallery_group_name">Group Name</label>
                                                <input type="text" name="edit_gallery_group_name" id="edit_gallery_group_name" placeholder="Group Name : School Compound" required>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Update Gallery Group</button>
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

                    {{-- DELETE CONFIRMATION --}}
                    <div class="modal fade" id="deleteGalleryGroupWin" tabindex="-1" aria-labelledby="deleteGalleryGroup" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteGalleryGroup">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this gallery group? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" class="btn btn-sm btn-info" id="confirm_delete_group"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="single-widget-container">
                        @if (count($gallery_group) > 0)
                            <ul class="class">
                                @foreach ($gallery_group as $item)
                                    <li>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="#">{{$item->group_name ?? "NA"}}</a>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <input type="hidden" value="{{json_encode($item)}}" id="group_data_{{$item->group_id}}">
                                                <a href="#!" class="group_editor" id="group_editor_{{$item->group_id}}" data-bs-toggle="modal" data-bs-target="#updateGalleryGroup"><i class="fa fa-pencil"></i></a>
                                                <a href="#!"><i class="fa fa-pencsil"></i></a>
                                                <a href="#!" class="group_deletor" id="group_deletor_{{$item->group_id}}" data-bs-toggle="modal" data-bs-target="#deleteGalleryGroupWin"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No gallery groups present at the moment!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Gallery Area-->
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
            selector: '#about_us_editor',
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
        });

    </script>
    <script src="/resources/js/homepage.js"></script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
