<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Under Maintenance" />

<body>
    {{-- mobile menu and desktop menu --}}
    {{-- <x-menu active="aboutus"/> --}}

    {{-- BODY STARTS HERE --}}
    <!--Breadcrumb Banner Area Start-->
    <div class="breadcrumb-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-text">
                        <h1 class="text-center">Page is Under Maintenance</h1>
                        <div class="breadcrumb-bar">
                            <ul class="breadcrumb">
                                <li><a href="/">Home</a></li>
                                <li>Under Maintenance</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Breadcrumb Banner Area-->

    <!--About Area Start-->
    <div class="about-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="mx-auto my-2 bg-red p-2 rounded-2 border border-gray" style="background: rgb(238, 238, 238)">
                        <h4 class="text-center">Login</h4>
                        <form action="/Login" method="post">
                            @csrf
                            <p class="text-danger">{{session("error") ? session("error") : ""}}</p>
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
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!--End of About Area-->
</body>

</html>
