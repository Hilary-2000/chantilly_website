<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-edit-header title="Edit Vacancy Application - Chantilly Schools" />

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
                                    <a class="btn btn-sm btn-info" id="confirm_delete_applicant"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="col-md-12 table-responsive">
                    <h4 class="text-center">Application made for : <u>{{count($vacancy_data) > 0 ? ucwords(strtolower($vacancy_data[0]->vacancy_title)) : "In-valid"}}</u></h4>
                    <a href="/Vacancies/Edit/" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back to Vacancies</a>
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th><input type="checkbox"> No.</th>
                                <th>Applicant Name</th>
                                <th>Application Date</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if (count($vacancy_application) > 0)
                            <tbody>
                                @foreach ($vacancy_application as $key => $item)
                                    <tr>
                                        <th><input type="checkbox"> {{$key+1}}.</th>
                                        <td>{{ucwords(strtolower($item->fullname))}}</td>
                                        <td>{{date("D dS M Y", strtotime($item->DOA))}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                            <a href="/Vacancies/View/{{$item->vacancy_id}}/Applications/{{$item->application_id}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-outline-info delete_applicant" id="delete_applicant_{{$item->application_id}}" data-bs-toggle="modal" data-bs-target="#deleteVacancyWindow" href="#!"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center">No application done yet!</td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--End of Class List Area-->
    {{-- BODY ENDS HERE --}}
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/{{env("TINY_MCE_KEY")}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

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
            var delete_applicant = document.getElementsByClassName("delete_applicant");
            for (let index = 0; index < delete_applicant.length; index++) {
                const element = delete_applicant[index];
                element.addEventListener("click", function () {
                    cObj("confirm_delete_applicant").href = "/Vacancies/Delete/Applicant/"+element.id.substr(17);
                });
            }
        });

    </script>
    <script src="/resources/js/homepage.js"></script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
