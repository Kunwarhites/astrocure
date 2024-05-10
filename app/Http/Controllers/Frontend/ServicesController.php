<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Feedback;
use Illuminate\Http\Request;
use DB;
class ServicesController extends Controller
{
    public function index(){
        $services = Service::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $testimonials = Feedback::where('status', 1)->orderBy('created_at', 'DESC')->get();
        if (session()->has('loggedInUser')) {
            $userinfo = DB::table('users')
                ->where('id', session('loggedInUser'))
                ->first();

            if ($userinfo) {
                return view('Frontend.service', compact('services', 'userinfo','testimonials'));
            }
        }

        return view('Frontend.service', compact('services', 'testimonials'));
    }

    public function detail($id) {
        $service = Service::where('id', $id)->first();

        // Check if the service exists; if not, redirect to another page.
        if (empty($service)) {
            return redirect('/');
        }

        // Check if the user is logged in and fetch user information if available.
        $userinfo = null;
        if (session()->has('loggedInUser')) {
            $userinfo = DB::table('users')
                ->where('id', session('loggedInUser'))
                ->first();
        }

        return view('Frontend.servicesingle', compact('service', 'userinfo'));
    }

}
