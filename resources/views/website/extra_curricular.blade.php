<!DOCTYPE html>
<html lang="en">
    {{-- header title favicon etc --}}
    <x-header title="Chantilly Schools ExtraCurricular"/>
<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="extra_curricula"/>

    {{-- BODY STARTS HERE --}}
    <div class="container w-100">

        <!-- Modal Structure for history value-->
        <div class="modal fade bd-example-modal-lg" id="editCurriculum" tabindex="-1"
            aria-labelledby="editAnEvent" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title"><u>View Extra-Curriculum!</u></h6>
                        <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="contact-form-container">
                            <div class="single-class">
                                <div class="single-class-image">
                                    <a href="#!">
                                        <img id="extra_curricular_image_src" src="" alt="">
                                    </a>
                                </div>
                                <div class="single-class-text">
                                    <div class="class-des">
                                        <h4><a href="#" id="curricular_title">N/A</a></h4>
                                        <p id="curricular_description">N/A</p>
                                    </div>
                                </div>
                            </div>
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
                                    <span class="class-date"><i class="fa fa-eye"></i> <span>View</span></span>
                                </a>
                            </div>
                            <div class="single-class-text">
                                <div class="class-des">
                                    <h4><a href="#">{{ $item->extra_curriculum_title }}</a></h4>
                                    <p>{{ $item->extra_curriculum_description }}</p>
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

        window.addEventListener("load", function () {
            var extra_curriculum = document.getElementsByClassName("extra_curriculum");
            for (let index = 0; index < extra_curriculum.length; index++) {
                const element = extra_curriculum[index];
                element.addEventListener("click", function () {
                    var extra_curriculum_data = cObj("extra_curriculum_data_"+element.id.substr(17)).value;
                    if (hasJsonStructure(extra_curriculum_data)) {
                        var extra_curricula = JSON.parse(extra_curriculum_data);

                        cObj("curricular_title").innerText = extra_curricula.extra_curriculum_title;
                        cObj("curricular_description").innerText = extra_curricula.extra_curriculum_description;
                        cObj("extra_curricular_image_src").src = extra_curricula.extra_curriculum_image;
                    }
                });
            }
        })
    </script>

    {{-- FOOTER --}}
    <x-footer page="extra_curricula"/>
</body>
</html>