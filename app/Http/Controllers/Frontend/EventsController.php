<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use DB;
class EventsController extends Controller
{
    public function index(){
        if (session()->has('loggedInUser')) {
            // Session variable 'loggedInUser' exists
            $data = [
                'userinfo' => DB::table('users')
                    ->where('id', session('loggedInUser'))
                    ->first(),
            ];
            $events = Event::where('status', 1)->orderBy('created_at', 'DESC')->get();
            return view('Frontend.event', $data)->with(compact('events'));
        } else {
            // Session variable 'loggedInUser' does not exist
            $events = Event::where('status', 1)->orderBy('created_at', 'DESC')->get();
            return view('Frontend.event')->with(compact('events'));
        }
    }
    public function detail($name){
        $event = Event::where('name', $name)->first();
        $recentevent = Event::where('status', 1)->orderBy('created_at', 'DESC')->paginate(4);

        if (empty($event)) {
            return redirect('/');
        }
        $userinfo = null;
        if (session()->has('loggedInUser')) {
            $userinfo = DB::table('users')->where('id', session('loggedInUser'))->first();
        }
        return view('Frontend.eventdetail', compact('event', 'userinfo','recentevent'));
    }

}
