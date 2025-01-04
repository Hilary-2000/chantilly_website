<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-edit-header title="Edit - Chantilly Schools Download" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="edit_downloads" />

    {{-- BODY STARTS HERE --}}
    <div class="about-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title">
                            <h3>DOWNLOADS</h3>
                            <p>Get all the documents you need.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
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
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDownloads"><i class="fa fa-plus"></i> Add documents</button>

                    <!-- Modal Structure for history value-->
                    <div class="modal fade bd-example-modal-lg" id="addDownloads" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="contactFormModalLabel">Add Download Documents</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="contact-form" action="/Download/Edit/add" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="document_title">Document Title</label>
                                                <input type="text" name="document_title" id="document_title" placeholder="Document title" placeholder="Document Title" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="document_status">Document Status</label>
                                                <select name="document_status" id="document_status" required>
                                                    <option value="" hidden>Select option</option>
                                                    <option value="1">Visible</option>
                                                    <option value="0">Hidden</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="document_file">Document File</label>
                                                <input type="file" name="document_file" id="document_file" accept=".pdf,.docx,.doc" placeholder="Document title" placeholder="Document Title" required>
                                            </div>
                                            <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Save Document</button>
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
                    <div class="modal fade bd-example-modal-lg" id="editDownloads" tabindex="-1" aria-labelledby="editFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h6 class="modal-title" id="editFormModalLabel">Edit Download Documents</h6>
                                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="contact-form-1" action="/Download/Edit/edit" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="hidden" name="edit_document_id" id="edit_document_id">
                                                <label for="edit_document_title">Document Title</label>
                                                <input type="text" name="edit_document_title" id="edit_document_title" placeholder="Document title" placeholder="Document Title" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_document_status">Document Status</label>
                                                <select name="edit_document_status" id="edit_document_status" required>
                                                    <option value="" hidden>Select option</option>
                                                    <option value="1">Visible</option>
                                                    <option value="0">Hidden</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <a href="#" class="text-primary" download id="download_link_edit"><i class="fa fa-download"></i> Download <span id="document_title_edit"></span>.</a>
                                                <br><label for="edit_document_file">Document File</label>
                                                <input type="file" name="edit_document_file" id="edit_document_file" accept=".pdf,.docx,.doc" placeholder="Document title" placeholder="Document Title" required>
                                            </div>
                                            <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Save Document</button>
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
                    <div class="modal fade" id="deleteDownload" tabindex="-1" aria-labelledby="deleteDownloadModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteDownloadModal">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" class="btn btn-sm btn-info" id="confirmDeleteDownload"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text-container">
                        <ul>
                            @if (count($downloads) > 0)
                                @foreach ($downloads as $download)
                                    <li class="text-lg text-primary text-bold my-2"><button data-bs-toggle="modal" data-bs-target="#deleteDownload" class="btn btn-sm btn-outline-info delete_download" id="delete_download_{{$download->download_id}}"><i class="fa fa-trash"></i></button> <input type="hidden" id="document_data_{{$download->download_id}}" value="{{json_encode($download)}}"> <button id="edit_document_{{$download->download_id}}" class="btn btn-sm btn-outline-primary edit_document" data-bs-toggle="modal" data-bs-target="#editDownloads"><i class="fa fa-pencil"></i></button>  <a href="/Download/Edit/status/{{$download->download_id}}" class="btn {{$download->display == "1" ? "btn-primary" : "btn-warning"}} btn-sm"><i class="fa {{$download->display == "1" ? "fa-eye" : "fa-eye-slash"}}"></i></a> | <i class="fa fa-file-pdf-o"></i> <a href="{{$download->download_file}}" class="text-primary" download>Download {{$download->download_title}}.</a></li>
                                @endforeach
                            @else
                                <li class="text-lg text-primary text-bold">No documents saved yet</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        function cObj(document_id) {
            return document.getElementById(document_id);
        }
        window.addEventListener("load", function () {
            var edit_document = document.getElementsByClassName("edit_document");
            for (let index = 0; index < edit_document.length; index++) {
                const element = edit_document[index];
                element.addEventListener("click", function () {
                    var element_data = cObj("document_data_"+element.id.substr(14)).value;
                    console.log(element_data);
                    if(hasJsonStructure(element_data)){
                        var decoded_data = JSON.parse(element_data);

                        cObj("edit_document_title").value = decoded_data.download_title;
                        cObj("download_link_edit").href = decoded_data.download_file;
                        cObj("document_title_edit").innerHTML = decoded_data.download_title;
                        cObj("edit_document_id").value = decoded_data.download_id;

                        var children = cObj("edit_document_status").children;
                        for (let index = 0; index < children.length; index++) {
                            const element = children[index];
                            if (element.value == decoded_data.display) {
                                element.selected = true;
                            }
                        }
                        cObj("edit_document_id").value = decoded_data.display;
                    }
                });
            }

            var delete_download = document.getElementsByClassName("delete_download");
            for (let index = 0; index < delete_download.length; index++) {
                const element = delete_download[index];
                element.addEventListener("click", function () {
                    cObj("confirmDeleteDownload").href = "/Download/Edit/delete/"+element.id.substr(16);
                });
            }
        });
    </script>
    <script src="/resources/js/homepage.js"></script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>