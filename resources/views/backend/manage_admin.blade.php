<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-edit-header title="Administrators - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="" />

    {{-- BODY STARTS HERE --}}
    <!--Class List Area Start-->
    <div class="class-list-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 my-2">

                    {{-- delete confirmatiom --}}
                    <div class="modal fade" id="deleteAdminWindow" tabindex="-1" aria-labelledby="deleteVacancy" aria-hidden="true">
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
                                    <a class="btn btn-sm btn-info" id="confirm_delete_admin"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- edit Confirmation Modal for carrousels-->
                    <div class="modal fade" id="addAdministratorModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Add Administrator</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="contact-form-container">
                                        <form id="contact-form-2" action="/SchoolAccount/AdminProfile/Add" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="fullname"><h6 style="font-size: 12px;">Fullname</h6></label>
                                                <input type="text" name="fullname" placeholder="New Admin Name *" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="phonenumber"><h6 style="font-size: 12px;">Phone Number</h6></label>
                                                <input type="text" name="phonenumber" placeholder="New Admin Phone Number *" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="email_address"><h6 style="font-size: 12px;">E-mail Address</h6></label>
                                                <input type="email" name="email_address" placeholder="New Admin Email *" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="physical_address"><h6 style="font-size: 12px;">Physical Address</h6></label>
                                                <input type="text" name="physical_address" placeholder="Banana, Kiambu *" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="username"><h6 style="font-size: 12px;">Username</h6></label>
                                                <input type="text" name="username" placeholder="Admin`s Username *" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="password"><h6 style="font-size: 12px;">Password</h6></label>
                                                <input type="password" name="password" placeholder="Password`s Username *" >
                                            </div>
                                            <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Save</button>
                                        </form>
                                    </div>
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
                    <h4 class="text-center">Administrator List</u></h4>
                    <button data-bs-toggle="modal" data-bs-target="#addAdministratorModal" class="btn btn-sm btn-primary my-2"><i class="fa fa-plus"></i> Add Administrator</button>
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th><input type="checkbox"> No.</th>
                                <th>Administrator Name</th>
                                <th>Registration Date</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if (count($admins) > 0)
                            <tbody>
                                @foreach ($admins as $key => $item)
                                    <tr>
                                        <th><input type="checkbox"> {{$key+1}}.</th>
                                        <td>{{ucwords(strtolower($item->fullname))}}</td>
                                        <td>{{date("D dS M Y", strtotime($item->date_registered))}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                            <a href="/SchoolAccount/Admin/View/{{$item->user_id}}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-outline-info delete_admin" id="delete_admin_{{$item->user_id}}" data-bs-toggle="modal" data-bs-target="#deleteAdminWindow" href="#!"><i class="fa fa-trash"></i> Delete</a>
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
        var delete_admin = document.getElementsByClassName("delete_admin");
        for (let index = 0; index < delete_admin.length; index++) {
            const element = delete_admin[index];
            cObj("confirm_delete_admin").href = "/SchoolAccount/AdminProfile/delete/"+element.id.substr(13);
        }
    </script>
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
