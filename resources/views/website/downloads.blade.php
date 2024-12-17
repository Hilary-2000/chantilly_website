<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Downloads - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="downloads"/>

    {{-- BODY STARTS HERE --}}
    <!--Breadcrumb Banner Area Start-->
    <div class="breadcrumb-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-text">
                        <h1 class="text-center">Downloads</h1>
                        <div class="breadcrumb-bar">
                            <ul class="breadcrumb">
                                <li><a href="/">Home</a></li>
                                <li>Downloads</li>
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
                <div class="col-md-12">
                    <div class="section-title-wrapper">
                        <div class="section-title">
                            <h3>DOWNLOADS</h3>
                            <p>Get all the documents you need.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text-container">
                        <ol type="1">
                            @if (count($downloads) > 0)
                                @foreach ($downloads as $download)
                                    <li class="text-lg text-primary text-bold my-2"><i class="fa fa-arrow-right"></i> <i class="fa fa-file-pdf-o"></i> <a href="{{$download->download_file}}" class="text-primary" download>Download {{$download->download_title}}.</a></li>
                                @endforeach
                            @else
                                <li class="text-lg text-primary text-bold">No documents saved yet</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of About Area-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer page="aboutus" />
</body>

</html>
