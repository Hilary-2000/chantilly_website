<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Chantilly Schools Homepage" />

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
                            <h3>Personal Information</h3>
                        </div>
                        <p>Modify your personal information.</p>
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
                                <div class="teacher-image-carousel">
                                    <img src="{{$user_data->display_picture != null ? $user_data->display_picture : "/img/no-image.png"}}" alt="Data">
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Fullname</h4>
                                    <span>{{ucwords(strtolower($user_data->fullname))}}</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Phone</h4>
                                    <span><a href="tel:{{$user_data->phone}}">{{$user_data->phone}}</a></span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Email</h4>
                                    <span><a target="_blank" href="mailto:{{$user_data->email}}">{{$user_data->email}}</a></span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Physical Address</h4>
                                    <span>{{$user_data->physical_address}}</span>
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
                            <form id="contact-form" action="/SchoolAccount/MyProfile/Update" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user_data->user_id}}">
                                <label for="fullname"><h6 style="font-size: 12px;">Fullname</h6></label>
                                <input type="text" name="fullname" placeholder="Your Name *" value="{{$user_data->fullname}}">
                                <label for="phonenumber"><h6 style="font-size: 12px;">Phone Number</h6></label>
                                <input type="text" name="phonenumber" placeholder="Your Phone Number *" value="{{$user_data->phone}}">
                                <label for="email_address"><h6 style="font-size: 12px;">E-mail Address</h6></label>
                                <input type="email" name="email_address" placeholder="Your Email *" value="{{$user_data->email}}">
                                <label for="physical_address"><h6 style="font-size: 12px;">Physical Address</h6></label>
                                <input type="text" name="physical_address" placeholder="Banana, Kiambu *" value="{{$user_data->physical_address}}">
                                <label for="profile_picture"><h6 style="font-size: 12px;">Profile Picture</h6></label>
                                <input type="file" name="profile_picture">
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
