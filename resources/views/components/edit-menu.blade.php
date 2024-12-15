<!--Header Area Start-->
@php
use Illuminate\Support\Facades\Cookie;
@endphp
<header>
    <div class="header-top">
        <div class="container p-1">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="header-top-info">
                        <div class="social-links mt-4">
                            <a target="_blank" href="https://www.facebook.com/chantillyschools/"><i class="fa fa-facebook"></i></a>
                            <a target="_blank" href="https://www.instagram.com/chantillyschools.kaizen/"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 p-2">
                    @if (session('error'))
                        <div class="alert alert-info py-1 text-center my-1">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="header-login-register">
                        @php
                            $user_data = session()->has('user_data') ? session("user_data", null) : null;
                            $greeting = date("H") < 12 ? "Goodmorning" : (date("H") < 16 ? "Hello" : "Goodevening");
                        @endphp
                        <ul class="login w-100">
                            <li>
                                <div class="row align-items-center">
                                    <div class="{{Cookie::has("authentication_code") ? "col-sm-6" : "col-sm-12"}}">
                                        <a href="#"><i class="{{Cookie::has("authentication_code") ? "fa fa-user" : "fa fa-key"}}"></i>{{ Cookie::has("authentication_code") ? ($user_data != null ? ucwords(strtolower(explode(" ", $user_data->fullname)[0])) : "Invalid User") : "Login"}}</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="user-profile m-1 {{Cookie::has("authentication_code") ? "" : "d-none"}}">
                                            <img src="{{$user_data != null ? $user_data->display_picture ?? "/img/no-image.png" : "/img/no-image.png"}}" alt="teacher 3">
                                        </div>
                                    </div>
                                </div>
                                <div class="login-form">
                                    <div class="{{Cookie::has("authentication_code") ? "d-none" : "" }}">
                                        <h4>Login</h4>
                                        <form action="/Login" method="post">
                                            @csrf
                                            <div class="form-box">
                                                <i class="fa fa-user"></i>
                                                <input type="text" name="user-name" placeholder="Username">
                                            </div>
                                            <div class="form-box">
                                                <i class="fa fa-lock"></i>
                                                <input type="password" name="user-password" placeholder="Password">
                                            </div>
                                            <div class="button-box">
                                                <button type="submit" class="login-btn">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="{{ Cookie::has("authentication_code") ? "" : "d-none" }}">
                                        <h6>{{$greeting}}, {{$user_data != null ? ucwords(strtolower(explode(" ", $user_data->fullname)[0])) : "Invalid User"}}</h6>
                                        <div class="">
                                            <div class="row p-1 align-items-center hover-text">
                                                <div class="col-sm-4">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="col-md-8">
                                                    <a href="#" class="text-secondary text-left">My Profile</a>
                                                </div>
                                            </div>
                                            <div class="row p-1 align-items-center hover-text">
                                                <div class="col-md-4">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="col-md-8">
                                                    <a href="#" class="text-secondary text-left">Manage Admin</a>
                                                </div>
                                            </div>
                                            <div class="row p-1 align-items-center hover-text">
                                                <div class="col-md-4">
                                                    <i class="fa fa-globe"></i>
                                                </div>
                                                <div class="col-md-8">
                                                    <a href="/" class="text-secondary text-left">Back to Wesbite</a>
                                                </div>
                                            </div>
                                            <div class="border border-secondary border-rounded-sm">
                                                <a href="/Logout" class="btn btn-sm btn-outline-info w-100">Log-Out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!--Logo Mainmenu Start-->
    <div class="header-logo-menu sticker">
        <div class="container">
            <div class="logo-menu-bg">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="logo">
                            <a href="/"><img src="/img/logo/chantilly_logo.png" alt="TECHEDU"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 d-none d-lg-block">
                        <div class="mainmenu-area">
                            <div class="mainmenu">
                                <nav>
                                    <ul id="nav">
                                        <li class="{{$active == "edit_home" ? "active" : ""}}"><a href="/Homepage/Edit">Edit - Homepage</a></li>
                                        <li class="{{$active == "edit_aboutus" ? "active" : ""}}"><a href="/AboutUs/Edit">Edit - About us</a></li>
                                        <li class="{{$active == "edit_events" ? "active" : ""}}"><a href="/Events/Edit">Edit - Events</a></li>
                                        <li class="{{$active == "edit_gallery" ? "active" : ""}}"><a href="/Gallery/Edit">Edit - Gallery</a></li>
                                        <li class="{{$active == "edit_vacancy" ? "active" : ""}}"><a href="/Vacancies/Edit/">Edit - Vacancies</a></li>
                                        <li class="{{$active == "edit_downloads" ? "active" : ""}}"><a href="/Downloads/Edit">Edit - Downloads</a></li>
                                        {{-- <li class="{{$active == "contactus" ? "active" : ""}}"><a href="/ContactUs">Edit - Contact Us</a></li> --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!--End of Logo Mainmenu-->
    <!-- Mobile Menu Area start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul>
                                <li class="{{$active == "edit_home" ? "active" : ""}}"><a href="/Homepage/Edit">Edit - Homepage</a></li>
                                <li class="{{$active == "edit_aboutus" ? "active" : ""}}"><a href="/AboutUs/Edit">Edit - About us</a></li>
                                <li class="{{$active == "edit_events" ? "active" : ""}}"><a href="/Events/Edit">Edit - Events</a></li>
                                <li class="{{$active == "edit_gallery" ? "active" : ""}}"><a href="/Gallery/Edit">Edit - Gallery</a></li>
                                <li class="{{$active == "edit_vacancy" ? "active" : ""}}"><a href="/Vacancies/Edit/">Edit - Vacancies</a></li>
                                <li class="{{$active == "edit_downloads" ? "active" : ""}}"><a href="/Downloads/Edit">Edit - Downloads</a></li>
                            </ul>
                        </nav>
                    </div>					
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area end -->  
</header>
<!--End of Header Area-->