<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class website extends Controller
{
    // 
    public function getHomepage(){
        $carrousel = DB::select("SELECT * FROM `homepage_carrousel` WHERE display = '1'");
        $curricullum = DB::select("SELECT * FROM homepage_curriculum WHERE display = '1'");
        
        $homepage_stats = DB::select("SELECT * FROM `homepage_stats`;");
        $home_stats = array(
            "teachers" => 0,
            "students" => 0,
            "classes" => 0
        );
        foreach ($homepage_stats as $key => $homepage_stat) {
            $home_stats[$homepage_stat->stats_title] = $homepage_stat->stats_count;
        }

        // services
        $services = DB::select("SELECT * FROM homepage_service WHERE display = '1';");
        return view("website.homepage", ["services" => $services, "carrousel" => $carrousel, "curricullum" => $curricullum, "homepage_stats" => $home_stats]);
    }

    public function getAboutsUs(){
        $history = DB::select("SELECT * FROM aboutus_history WHERE history_display = '1';");
        $history_image = DB::select("SELECT * FROM history_image;");
        $awards = DB::select("SELECT * FROM aboutus_awards WHERE award_display = '1'");

        return view("website.aboutus", ["history" => $history, "history_image" => $history_image, "awards" => $awards]);
    }

    public function getEvents(){
        $events = ['live', 'happened', 'upcoming'];
        $event_data = [];
        foreach ($events as $event) {
            $event_type = DB::select("SELECT * FROM events WHERE event_type = ? AND display = '1'", [$event]);
            foreach ($event_type as $key => $value) {
                $event_type[$key]->fulldate = date("Y-m-d", strtotime($value->event_start_date));
            }
            $event_data[$event] = $event_type;
        }

        return view("website.events", ["event_data" => $event_data]);
    }
    //
    public function get_gallery(){
        $gallery = DB::select("SELECT * FROM gallery LEFT JOIN gallery_groups ON gallery_groups.group_id = gallery.gallery_group_id WHERE image_status = '1'");
        $gallery_group = DB::select("SELECT * FROM `gallery_groups`");
        return view("website.gallery", ["gallery_group" => $gallery_group, "gallery" => $gallery]);
    }

    // downloads
    public function get_downloads(){
        $downloads = DB::select("SELECT * FROM downloads WHERE display = '1'");
        return view("website.downloads", ["downloads" => $downloads]);
    }
}
