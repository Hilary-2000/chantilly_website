<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Events - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="events"/>

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

    {{-- BODY STARTS HERE --}}

    <!--Breadcrumb Banner Area Start-->
    <div class="breadcrumb-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-text">
                        <h1 class="text-center">Events</h1>
                        <div class="breadcrumb-bar">
                            <ul class="breadcrumb">
                                <li><a href=".">Home</a></li>
                                <li>Events</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Breadcrumb Banner Area-->
    
    <!--Class List Area Start-->
    <div class="class-list-area section-padding">

        {{-- LIVE EVENTS --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <h3>Live Events</h3>
                    </div>
                </div>    
            </div>
            @if (count($event_data['live']) > 0)
                @foreach ($event_data['live'] as $event)
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <input type="hidden" value='{{json_encode($event)}}' id="event_data_{{$event->event_id}}">
                                        <a href="#" class="{{$event->event_video_link != null ? "d-none" : ""}}"><img src="{{$event->event_image}}" alt=""></a>
                                        <iframe class="{{$event->event_video_link != null ? "" : "d-none"}}"
                                            style="width: 25vw; height: 25vh;"
                                            src="{{$event->event_video_link != null ? convertToEmbedLink($event->event_video_link) : "https://www.youtube.com/embed/dzVC4nUXgd8"}}"
                                            title="{{$event->event_title}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{$event->event_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Event Date: {{date("D dS M Y", strtotime($event->event_start_date))}}</span>
                                            </div>
                                            <p>
                                                {{$event->event_description}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-secondary">No live events at the moment!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- LIVE EVENTS --}}

        {{-- UPCOMING EVENTS --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <h3>Upcoming Events</h3>
                    </div>
                </div>    
            </div>
            @if (count($event_data['upcoming']) > 0)
                @foreach ($event_data['upcoming'] as $event)
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <input type="hidden" value="{{json_encode($event)}}" id="event_data_{{$event->event_id}}">
                                        <a href="#" class="{{$event->event_video_link != null ? "d-none" : ""}}"><img src="{{$event->event_image}}" alt=""></a>
                                        <iframe class="{{$event->event_video_link != null ? "" : "d-none"}}"
                                            style="width: 25vw; height: 25vh;"
                                            src="{{$event->event_video_link != null ? convertToEmbedLink($event->event_video_link) : "https://www.youtube.com/embed/dzVC4nUXgd8"}}"
                                            title="{{$event->event_title}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{$event->event_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Event Date: {{date("D dS M Y", strtotime($event->event_start_date))}}</span>
                                            </div>
                                            <p>
                                                {{$event->event_description}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-secondary">No upcoming events at the moment!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- UPCOMING EVENTS --}}

        {{-- PAST EVENTS --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                        <h3>Past Events</h3>
                    </div>
                </div>    
            </div>
            @if (count($event_data['happened']) > 0)
                @foreach ($event_data['happened'] as $event)
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="class-list-item">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                        <input type="hidden" value='{{json_encode($event)}}' id="event_data_{{$event->event_id}}">
                                        <a href="#" class="{{$event->event_video_link != null ? "d-none" : ""}}"><img src="{{$event->event_image}}" alt=""></a>
                                        <iframe class="{{$event->event_video_link != null ? "" : "d-none"}}"
                                            style="width: 25vw; height: 25vh;"
                                            src="{{$event->event_video_link != null ? convertToEmbedLink($event->event_video_link) : "https://www.youtube.com/embed/dzVC4nUXgd8"}}"
                                            title="{{$event->event_title}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <div class="class-list-text">
                                            <h3><a href="#">{{$event->event_title}}</a></h3>
                                            <div class="class-information">
                                                <span>Event Date: {{date("D dS M Y", strtotime($event->event_start_date))}}</span>
                                            </div>
                                            <p>
                                                {{$event->event_description}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="class-list-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-secondary">No past events at the moment!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- PAST EVENTS --}}
    </div>
    <!--End of Class List Area-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer page="events"/>
</body>

</html>