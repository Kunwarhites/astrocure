<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Astrologer;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;

class HomeController extends Controller
{
    public function index(){
        if (session()->has('loggedInUser')) {
            // Session variable 'loggedInUser' exists
            $data = [
                'userinfo' => DB::table('users')
                    ->where('id', session('loggedInUser'))
                    ->first(),
            ];
            $banners = Banner::where('status', 1)->orderBy('created_at', 'DESC')->get();
            $events = Event::where('status', 1)->orderBy('created_at', 'DESC')->get();
            $services = Service::where('status', 1)->orderBy('created_at', 'DESC')->paginate(4);
            $blogs = Blog::where('status', 1)->orderBy('created_at', 'DESC')->paginate(3);
            $team = Astrologer::where('status', 1)->orderBy('created_at', 'DESC')->take(4)->get();
            $testimonials = Feedback::where('status', 1)->orderBy('created_at', 'DESC')->get();

            return view('Frontend.index', $data)->with(compact('services', 'team','blogs', 'events','testimonials','banners'));
        } else {
            // Session variable 'loggedInUser' does not exist
            $banners = Banner::where('status', 1)->orderBy('created_at', 'DESC')->get();
            $events = Event::where('status', 1)->orderBy('created_at', 'DESC')->get();
            $services = Service::where('status', 1)->orderBy('created_at', 'DESC')->paginate(4);
            $blogs = Blog::where('status', 1)->orderBy('created_at', 'DESC')->paginate(3);
            $team = Astrologer::where('status', 1)->orderBy('created_at', 'DESC')->take(4)->get();
            $testimonials = Feedback::where('status', 1)->orderBy('created_at', 'DESC')->get();
            
            return view('Frontend.index')->with(compact('services', 'team','blogs', 'events','testimonials','banners'));
        }
    }

    public function aboutus() {
        if (session()->has('loggedInUser')) {
            $userinfo = DB::table('users')
                ->where('id', session('loggedInUser'))
                ->first();
            if ($userinfo) {
                return view('Frontend.aboutus', compact('userinfo'));
            }
        }
        return view('Frontend.aboutus');
    }



}
