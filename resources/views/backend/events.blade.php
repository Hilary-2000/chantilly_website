<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Edit - Chantilly Schools About Us" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_events" />

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

    <!--About Area Start-->
    <div class="about-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary"  data-bs-toggle="modal" data-bs-target="#addNewEvent"><i class="fa fa-plus"></i> Add New Event</button>
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
                    
                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-lg" id="addNewEvent" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="contactFormModalLabel"><u>Add Event!</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/Events/Edit/add" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="openEditorData" name="content" required>
                                            <div class="mb-1">
                                                <label for="event_title">Event title</label>
                                                <input type="text" name="event_title" id="event_title" placeholder="Event title : Graduation Day" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="event_image">Event image</label>
                                                <input type="file" name="event_image" id="event_image" accept=".jpg, .jpeg, .png, .gif" placeholder="Event image" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="event_youtube_link">Event youtube link</label>
                                                <input type="text" name="event_youtube_link" id="event_youtube_link" placeholder="https://www.youtube.com/watch?v=">
                                            </div>
                                            <div class="mb-1">
                                                <label for="start_date">Date Start</label>
                                                <input type="date" value="{{date("Y-m-d")}}" name="start_date" id="start_date" required>
                                            </div>
                                            {{-- <div class="mb-1">
                                                <label for="end_date">Date End</label>
                                                <input type="date" value="{{date("Y-m-d")}}" name="end_date" id="end_date" required>
                                            </div> --}}
                                            <div class="mb-1">
                                                <label for="event_type">Event Type</label>
                                                <select name="event_type" id="event_type">
                                                    <option value="" hidden>Select event type!</option>
                                                    <option value="upcoming">Upcoming event!</option>
                                                    <option value="happened">Past Event!</option>
                                                    <option value="live">Live Event!</option>
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="event_description">Event description</label>
                                                <textarea id="event_description" name="event_description" placeholder="Brief event description.."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Save Event</button>
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
                    
                    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteCurriculumModal" aria-hidden="true">
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
                                    <a href="#" class="btn btn-sm btn-danger" id="confirmEventDelete"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-lg" id="editEvent" tabindex="-1" aria-labelledby="editAnEvent" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editAnEvent"><u>Edit Event!</u></h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form action="/Events/Edit/update" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="edit_event_id" name="edit_event_id" required>
                                            <div class="mb-1">
                                                <label for="edit_event_title">Event title</label>
                                                <input type="text" name="edit_event_title" id="edit_event_title" placeholder="Event title : Graduation Day" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_event_image">Event image</label><br>
                                                <a href="/web-data/20241207201418.jpg" id="download_event_image" download="">
                                                    <i class="fa fa-download text-success"> Download Image</i>
                                                </a><br>
                                                <img id="view_event_image" width="100" height="100" src="/web-data/20241207201418.jpg">
                                                <input type="file" name="edit_event_image" id="edit_event_image" accept=".jpg, .jpeg, .png, .gif" placeholder="Event image" required>
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_event_youtube_link">Event youtube link</label>
                                                <input type="text" name="edit_event_youtube_link" id="edit_event_youtube_link" placeholder="https://www.youtube.com/watch?v=">
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_start_date">Date Start</label>
                                                <input type="date" value="{{date("Y-m-d")}}" name="edit_start_date" id="edit_start_date" required>
                                            </div>
                                            {{-- <div class="mb-1">
                                                <label for="edit_end_date">Date End</label>
                                                <input type="date" value="{{date("Y-m-d")}}" name="edit_end_date" id="edit_end_date" required>
                                            </div> --}}
                                            <div class="mb-1">
                                                <label for="edit_event_type">Event Type</label>
                                                <select name="edit_event_type" id="edit_event_type">
                                                    <option value="" hidden>Select event type!</option>
                                                    <option value="upcoming">Upcoming event!</option>
                                                    <option value="happened">Past Event!</option>
                                                    <option value="live">Live Event!</option>
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="edit_event_description">Event description</label>
                                                <textarea id="edit_event_description" name="edit_event_description" placeholder="Brief event description.."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa fa-save"></i> Update Evemt</button>
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
            </div>
        </div>

        {{-- LIVE EVENTS --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <h3>Live Events</h3>
                    </div>
                </div>    
            </div>
            @if (count($event_data['live']) > 0)
                @foreach ($event_data['live'] as $event)
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <input type="hidden" value='{{json_encode($event)}}' id="event_data_{{$event->event_id}}">
                                        <a href="#" class="{{$event->event_video_link != null ? "d-none" : ""}}"><img src="{{$event->event_image}}" alt=""></a>
                                        <iframe class="{{$event->event_video_link != null ? "" : "d-none"}}"
                                            style="width: 25vw; height: 25vh;"
                                            src="{{$event->event_video_link != null ? convertToEmbedLink($event->event_video_link) : "https://www.youtube.com/embed/dzVC4nUXgd8"}}"
                                            title="{{$event->event_title}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{$event->event_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Event Date: {{date("D dS M Y", strtotime($event->event_start_date))}}</span>
                                            </div>
                                            <p>
                                                {{$event->event_description}}
                                            </p>
                                            <button class="btn btn-sm btn-outline-primary event" id="event_id_{{$event->event_id}}" data-bs-toggle="modal" data-bs-target="#editEvent"><i class="fa fa-pencil"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger delete_event" id="del_event_id_{{$event->event_id}}" data-bs-toggle="modal" data-bs-target="#deleteEventModal"><i class="fa fa-trash"></i> Delete</button>
                                            <a href="/Events/Edit/Display/{{$event->event_id}}" class="btn btn-sm {{$event->display == "1" ? "btn-primary" : "btn-warning"}}"><i class="fa {{$event->display == "1" ? "fa-eye" : "fa-eye-slash"}}"></i> {{$event->display == "1" ? "visible" : "hidden"}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-secondary">No live events at the moment!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- LIVE EVENTS --}}

        {{-- UPCOMING EVENTS --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <h3>Upcoming Events</h3>
                    </div>
                </div>    
            </div>
            @if (count($event_data['upcoming']) > 0)
                @foreach ($event_data['upcoming'] as $event)
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <input type="hidden" value="{{json_encode($event)}}" id="event_data_{{$event->event_id}}">
                                        <a href="#" class="{{$event->event_video_link != null ? "d-none" : ""}}"><img src="{{$event->event_image}}" alt=""></a>
                                        <iframe class="{{$event->event_video_link != null ? "" : "d-none"}}"
                                            style="width: 25vw; height: 25vh;"
                                            src="{{$event->event_video_link != null ? convertToEmbedLink($event->event_video_link) : "https://www.youtube.com/embed/dzVC4nUXgd8"}}"
                                            title="{{$event->event_title}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{$event->event_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Event Date: {{date("D dS M Y", strtotime($event->event_start_date))}}</span>
                                            </div>
                                            <p>
                                                {{$event->event_description}}
                                            </p>
                                            <button class="btn btn-sm btn-outline-primary event" id="event_id_{{$event->event_id}}" data-bs-toggle="modal" data-bs-target="#editEvent"><i class="fa fa-pencil"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger delete_event" id="del_event_id_{{$event->event_id}}" data-bs-toggle="modal" data-bs-target="#deleteEventModal"><i class="fa fa-trash"></i> Delete</button>
                                            <a href="/Events/Edit/Display/{{$event->event_id}}" class="btn btn-sm {{$event->display == "1" ? "btn-primary" : "btn-warning"}}"><i class="fa {{$event->display == "1" ? "fa-eye" : "fa-eye-slash"}}"></i> {{$event->display == "1" ? "visible" : "hidden"}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-secondary">No upcoming events at the moment!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- UPCOMING EVENTS --}}

        {{-- PAST EVENTS --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <h3>Past Events</h3>
                    </div>
                </div>    
            </div>
            @if (count($event_data['happened']) > 0)
                @foreach ($event_data['happened'] as $event)
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <input type="hidden" value='{{json_encode($event)}}' id="event_data_{{$event->event_id}}">
                                        <a href="#" class="{{$event->event_video_link != null ? "d-none" : ""}}"><img src="{{$event->event_image}}" alt=""></a>
                                        <iframe class="{{$event->event_video_link != null ? "" : "d-none"}}"
                                            style="width: 25vw; height: 25vh;"
                                            src="{{$event->event_video_link != null ? convertToEmbedLink($event->event_video_link) : "https://www.youtube.com/embed/dzVC4nUXgd8"}}"
                                            title="{{$event->event_title}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{$event->event_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Event Date: {{date("D dS M Y", strtotime($event->event_start_date))}}</span>
                                            </div>
                                            <p>
                                                {{$event->event_description}}
                                            </p>
                                            <button class="btn btn-sm btn-outline-primary event" id="event_id_{{$event->event_id}}" data-bs-toggle="modal" data-bs-target="#editEvent"><i class="fa fa-pencil"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger delete_event" id="del_event_id_{{$event->event_id}}" data-bs-toggle="modal" data-bs-target="#deleteEventModal"><i class="fa fa-trash"></i> Delete</button>
                                            <a href="/Events/Edit/Display/{{$event->event_id}}" class="btn btn-sm {{$event->display == "1" ? "btn-primary" : "btn-warning"}}"><i class="fa {{$event->display == "1" ? "fa-eye" : "fa-eye-slash"}}"></i> {{$event->display == "1" ? "visible" : "hidden"}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-secondary">No past events at the moment!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- PAST EVENTS --}}
    </div>
    <!--End of About Area-->

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
            var school_events = document.getElementsByClassName("event");
            for (let index = 0; index < school_events.length; index++) {
                const element = school_events[index];
                element.addEventListener("click", function () {
                    var value = cObj("event_data_"+this.id.substr(9)).value;
                    if(hasJsonStructure(value)){
                        var event_data = JSON.parse(value);
                        cObj("edit_event_title").value = event_data.event_title;
                        cObj("edit_event_youtube_link").value = event_data.event_video_link;
                        cObj("edit_start_date").value = event_data.fulldate;
                        cObj("edit_event_description").value = event_data.event_description;
                        cObj("download_event_image").href = event_data.event_image
                        cObj("view_event_image").src = event_data.event_image
                        cObj("edit_event_id").value = event_data.event_id;
                        
                        var optChildren = cObj("edit_event_type").children;
                        for (let index = 0; index < optChildren.length; index++) {
                            const element = optChildren[index];
                            if(element.value == event_data.event_type){
                                element.selected = true;
                            }
                        }
                    }else{
                        console.log(value);
                    } 
                });
            }

            var delete_event = document.getElementsByClassName("delete_event");
            for (let index = 0; index < delete_event.length; index++) {
                const element = delete_event[index];
                element.addEventListener("click", function () {
                    cObj("confirmEventDelete").href = "/Events/Edit/Delete/"+element.id.substr(13);
                })
            }
        });

    </script>
    <script src="/resources/js/homepage.js"></script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
