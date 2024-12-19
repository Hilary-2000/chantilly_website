<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Schools Profile - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-edit-menu active="" />

    {{-- BODY STARTS HERE --}}
    <!--Contact Area Strat-->
    <div class="contact-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-area-container">
                        <div class="single-title">
                            <h3>School Information</h3>
                        </div>
                        <p>Modify your personal information.</p>
                        <!-- Delete Confirmation Modal for carrousels-->
                        <div class="modal fade" id="updateCredentialsModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Set-up Email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="contact-form-container">
                                            <a href="/SchoolAccount/SchoolProfile/resetEmail" class="btn btn-sm btn-outline-warning">Reset E-Mail Config</a>
                                            <form id="contact-form-2" action="/SchoolAccount/SchoolProfile/SetupEmail" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="sender_name">Sender Name</label>
                                                    <input type="text" value="{{$email_config->sender_name ?? "N/A"}}" name="sender_name"  placeholder="Enter sender name *" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="test_email_address">Test Email Address</label>
                                                    <input type="text" value="{{$email_config->test_email_address ?? "N/A"}}" name="test_email_address" id="test_email_address" placeholder="Test Email Address eg: tonny@gmail.com *" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email_host">Email Host</label>
                                                    <input type="text" value="{{$email_config->email_host ?? "N/A"}}" name="email_host" id="email_host" placeholder="Email Host *" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email_username">Username</label>
                                                    <input type="text" value="{{$email_config->email_username ?? "N/A"}}" name="email_username" id="email_username" placeholder="Email Username *" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email_password">Password</label>
                                                    <input type="text" value="{{$email_config->email_password ?? "N/A"}}" name="email_password" id="email_password" placeholder="Password *" required>
                                                </div>
                                                <button type="submit" class="btn btn-success w-100"><i class="fa fa-save"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#updateCredentialsModal"><i class="fa fa-cog"></i> Set-up E-mail</button>
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
                        <div class="contact-address-container">
                            <div class="contact-address-info">
                                <img style="max-height: 200px;" src="{{$school_data->school_logo ?? "/img/no-image.png"}}" alt="Data">
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>School Name</h4>
                                    <span>{{ucwords(strtolower($school_data->school_name ?? "N/A"))}}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Phone Number</h4>
                                    <span><a href="tel:{{$school_data->school_phone ?? "N/A"}}">{{$school_data->school_phone ?? "N/A"}}</a></span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>WhatsApp Number</h4>
                                    <span>{{$school_data->school_whatapp ?? "N/A"}}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>School Email</h4>
                                    <span><a target="_blank" href="mailto:{{$school_data->school_email ?? "N/A"}}">{{$school_data->school_email ?? "N/A"}}</a></span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Facebook Link</h4>
                                    <span>{{$school_data->school_facebook ?? "N/A"}}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Instagram Link</h4>
                                    <span>{{$school_data->school_instagram ?? "N/A"}}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>School Motto</h4>
                                    <span>{{$school_data->school_motto ?? "N/A"}}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Physical Address</h4>
                                    <span>{{$school_data->school_address ?? "N/A"}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="single-title">
                            <h3>Update your data!</h3>
                        </div>
                        <div class="contact-form-container">
                            <form id="contact-form" action="/SchoolAccount/SchoolProfile/Update" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="school_id" value="{{$school_data->school_id ?? "N/A"}}">
                                
                                <label for="school_logo"><h6 style="font-size: 12px;">School Logo</h6></label>
                                <input type="file" name="school_logo">
                                
                                <label for="school_name"><h6 style="font-size: 12px;">School Name</h6></label>
                                <input type="text" name="school_name" placeholder="Your Name *" value="{{$school_data->school_name ?? "N/A"}}">
                                
                                <label for="school_phone"><h6 style="font-size: 12px;">Phone Numbers</h6></label>
                                <input type="text" name="school_phone" placeholder="Your Phone Numbers *" value="{{$school_data->school_phone ?? "N/A"}}">
                                
                                <label for="school_whatapp"><h6 style="font-size: 12px;">WhatsApp Numbers</h6></label>
                                <input type="text" name="school_whatapp" placeholder="Your WhatsApp Numbers *" value="{{$school_data->school_whatapp ?? "N/A"}}">
                                
                                <label for="school_email"><h6 style="font-size: 12px;">E-mail Address</h6></label>
                                <input type="email" name="school_email" placeholder="School E-mail *" value="{{$school_data->school_email ?? "N/A"}}">
                                
                                <label for="school_address"><h6 style="font-size: 12px;">Physical Address</h6></label>
                                <input type="text" name="school_address" placeholder="Banana, Kiambu *" value="{{$school_data->school_address ?? "N/A"}}">
                                
                                <label for="school_facebook"><h6 style="font-size: 12px;">School Facebook Link</h6></label>
                                <input type="text" name="school_facebook" placeholder="Facebook Link - (Optional) *" value="{{$school_data->school_facebook ?? "N/A"}}">
                                
                                <label for="school_instagram"><h6 style="font-size: 12px;">School Instagram Link</h6></label>
                                <input type="text" name="school_instagram" placeholder="Instagram Link - (Optional) *" value="{{$school_data->school_instagram ?? "N/A"}}">
                                
                                <label for="school_motto"><h6 style="font-size: 12px;">School Motto</h6></label>
                                <input type="text" name="school_motto" placeholder="Banana, Kiambu *" value="{{$school_data->school_motto ?? "N/A"}}">
                                <button type="submit" class="button-default button-yellow submit"><i class="fa fa-send"></i>Submit</button>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Contact Area-->
    {{-- BODY ENDS HERE --}}
    {{-- FOOTER --}}
    <x-footer page="homepage" />
</body>

</html>
