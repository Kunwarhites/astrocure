<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use DB;

class FaqController extends Controller
{
    public function index(){
      if (session()->has('loggedInUser')) {
          // Session variable 'loggedInUser' exists
          $data = [
              'userinfo' => DB::table('users')
                  ->where('id', session('loggedInUser'))
                  ->first(),
          ];
          $faqs = Faq::where('status', 1)->orderBy('created_at', 'DESC')->get();
          return view('Frontend.faq', $data)->with(compact('faqs'));
      } else {
          // Session variable 'loggedInUser' does not exist
          $faqs = Faq::where('status', 1)->orderBy('created_at', 'DESC')->get();
          return view('Frontend.faq')->with(compact('faqs'));
      }
  }

    public function store(Request $request){
        $request->validate([
          'question' => 'required|max:255'
        ]);
        Faq::create($request->all());
    return redirect()->route('Front.faqStore')->with('success', 'Your Message has been Sent successfully.');
  }

}
