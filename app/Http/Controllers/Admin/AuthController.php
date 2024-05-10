<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Validator;
// Model
use Session;
use Hash;
use App\Models\Admin;
use App\Models\Subadmin;

class AuthController extends Controller {
    public function getLogin() {
        return view("Admins.SuperAdmin.login");
    }
    public function subgetLogin() {
        return view("Admins.SubAdmin.login");
    }


    public function postlogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = auth()->guard('admin')->user();

            // Check if the user is an admin with isadmin value set to 1
            if($user->isadmin == 1) {
                return redirect()->route('dashboard')->with('success', 'You are logged in successfully.');
            }

            if($user->isadmin == 0) {
                return back()->with('error', 'Your Are Not Admin');
            }
        }
        return back()->with('error', 'Whoops! Invalid email and password.');
    }
    public function subpostLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('subadmin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = auth()->guard('subadmin')->user();

            // Check if the user is a subadmin with isadmin value set to 0
            if($user->isadmin == 0) {
                return redirect()->route('subdashboard')->with('success', 'You are logged in successfully.');
            }
        }

        return back()->with('error', 'Whoops! Invalid email and password.');
    }


    public function logout(Request $request) {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect()->route('Admins.SuperAdmin.login');
    }

}
