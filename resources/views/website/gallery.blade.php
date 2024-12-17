<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Gallery - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="gallery"/>

    {{-- BODY STARTS HERE --}}
    <!--Gallery Area Start-->
    <div class="gallery-area section-padding gallery-full-width">
        <div class="row">
            <div class="col-md-12">
                <div class="container w-100">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter-menu">
                                <ul>
                                    <li class="filter" data-filter="all">All</li>
                                    @foreach ($gallery_group as $item)
                                        <li class="filter" data-filter=".{{$item->group_id}}">{{$item->group_name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filter-items">
                        <div class="row">
                            @foreach ($gallery as $item)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mix single-items {{$item->gallery_group_id}} overlay-hover">
                                    <div class="overlay-effect">
                                        <a aria-disabled="true" tabindex="-1"><img src="{{$item->image_path}}" alt=""></a>
                                        <div class="gallery-hover-effect">
                                            <input type="hidden" value="{{json_encode($item)}}" id="photo_details_{{$item->img_id}}">
                                            <a class="gallery-icon venobox" href="{{$item->image_path}}"><i class="fa fa-image"></i></a>
                                            <span class="gallery-text">{{$item->group_name}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Gallery Area-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer page="events"/>
</body>

</html>
