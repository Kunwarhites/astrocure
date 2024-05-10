<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use DB;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index(){
        if (session()->has('loggedInUser')) {
            // Session variable 'loggedInUser' exists
            $data = [
                'userinfo' => DB::table('users')
                    ->where('id', session('loggedInUser'))
                    ->first(),
            ];
            $blogs = Blog::where('status', 1)->orderBy('created_at', 'DESC')->get();
            return view('Frontend.blogs', $data)->with(compact('blogs'));
        } else {
            // Session variable 'loggedInUser' does not exist
            $blogs = Blog::where('status', 1)->orderBy('created_at', 'DESC')->get();
            return view('Frontend.blogs')->with(compact('blogs'));
        }
    }

    public function blogdetail($id) {
        $blogs = Blog::where('id', $id)->first();
        $recentblogs = Blog::where('status', 1)->orderBy('created_at', 'DESC')->paginate(4);

        if (empty($blogs)) {
            return redirect('/');
        }
        $userinfo = null;
        if (session()->has('loggedInUser')) {
            $userinfo = DB::table('users')->where('id', session('loggedInUser'))->first();
        }
        return view('Frontend.blogdetail', compact('blogs', 'userinfo','recentblogs'));
    }


}
