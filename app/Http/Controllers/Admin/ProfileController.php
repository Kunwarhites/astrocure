<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ProfileController extends Controller {
    public function index() {
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.profile', compact('user'));
    }
    public function update($id, Request $request) {
        $pro = Admin::find($id);

        // Update the Admin attributes
        $pro->isadmin = $request->isadmin;
        $pro->name = $request->name;
        $pro->email = $request->email;
        $pro->phone = $request->phone;
        $pro->gender = $request->gender;
        $pro->dob = $request->dob;
    
        // Check if a new password is provided
        if ($request->password !== null) {
            $pro->password = bcrypt($request->password);
        } else {
            $pro->password = $request->old_pass;
        }
    
        // Check if a new profile image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('images/Admins/Super/');
    
            // Move the uploaded image to the specified directory
            $image->move($imagePath, $imageName);
    
            // Delete the old image if it exists
            if (!empty($pro->image) && File::exists($pro->image)) {
                File::delete($pro->image);
            }
    
            // Save the new image path to the database
            $pro->image = 'images/Admins/Super/' . $imageName;
        }
    
        // Save the updated Admin instance to the database
        $pro->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
