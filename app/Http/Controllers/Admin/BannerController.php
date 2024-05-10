<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Validator;
use DataTables;
use Illuminate\Support\Facades\DB;
class BannerController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Banner::latest()->get();
            foreach ($data as $banner) {
                // Construct URLs for desktop and phone images
                $banner->image_urldesktop = url('uploads/banners/desktop/' . $banner->image_desktop);
                $banner->image_urlphone = url('uploads/banners/phone/' . $banner->image_phone);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Define action buttons for each row
                    $Btn = '<a href="javascript:void(0)" class="show fa-solid text-primary fa-eye btn-sm"></a>';
                    $editbtn = '<a href="' . route('editBanner', ['id' => $row->id]) . '" class="editModal fa-solid fa-pen-to-square text-success btn-sm"></a>';

                    $deleteBtn = '<a href="" id="' . $row->id . '" class="delete fa-solid fa-trash text-danger btn-sm"></a>';

                    return $Btn . ' ' . $editbtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.banner',compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image_desktop' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=1600,height=462',
            'image_phone' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=375,height=450',
        ]);
        $banner = new Banner();
        $banner->status = $request->status;
        if ($request->hasFile('image_desktop')) {
            $desktopImage = $request->file('image_desktop');
            $desktopImageName = time() . '_desktop.' . $desktopImage->getClientOriginalExtension();
            $desktopImage->move(public_path('uploads/banners/desktop'), $desktopImageName); // Store in 'banners' directory
            $banner->image_desktop = $desktopImageName;
        }

        if ($request->hasFile('image_phone')) {
            $phoneImage = $request->file('image_phone');
            $phoneImageName = time() . '_phone.' . $phoneImage->getClientOriginalExtension();
            $phoneImage->move(public_path('uploads/banners/phone'), $phoneImageName); // Store in 'banners' directory
            $banner->image_phone = $phoneImageName;
        }
        $banner->save();

        return response()->json([
            'status' => 200,
            'message' => 'Banner added successfully',
        ]);
    }
    public function editBanner(Request $request, $id)
    {
        $user = auth('admin')->user();
        $ban = Banner::find($id); // Use $id instead of $request->id
        return view('Admins.SuperAdmin.banner-edit', compact('user','ban'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'image_desktop' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=1600,height=462',
            'image_phone' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=375,height=450',
        ]);

        // Find the banner
        $banner = Banner::find($id);

        // Check if the banner exists
        if (!$banner) {
            return response()->json([
                'status' => 404,
                'message' => 'Banner not found',
            ]);
        }

        // Handle image_desktop
        if ($request->hasFile('image_desktop')) {
            if ($banner->image_desktop) {
                $desktopImagePath = public_path('uploads/banners/desktop/' . $banner->image_desktop);
                if (file_exists($desktopImagePath)) {
                    unlink($desktopImagePath);
                }
            }

            $desktopImage = $request->file('image_desktop');
            $desktopImageName = time() . '_desktop.' . $desktopImage->getClientOriginalExtension();
            $desktopImage->move(public_path('uploads/banners/desktop'), $desktopImageName);
            $banner->image_desktop = $desktopImageName;
        }


        // Handle image_phone
       // Handle image_phone (not image_desktop)
        if ($request->hasFile('image_phone')) {
            // Delete the old phone image if it exists
            if ($banner->image_phone) {
                $phoneImagePath = public_path('uploads/banners/phone/' . $banner->image_phone);
                if (file_exists($phoneImagePath)) {
                    unlink($phoneImagePath);
                }
            }
            // Store the new phone image
            $phoneImage = $request->file('image_phone');
            $phoneImageName = time() . '_phone.' . $phoneImage->getClientOriginalExtension();
            $phoneImage->move(public_path('uploads/banners/phone'), $phoneImageName);
            $banner->image_phone = $phoneImageName;
        }


        // Update the status
        $banner->status = $request->status;

        // Save the changes
        $banner->save();

        return redirect()
            ->route('banner')
            ->with('success', 'Banner updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(['error' => 'Banner not found'], 404);
        }

        // Delete images from public storage
        if ($banner->image_desktop) {
            $desktopImagePath = public_path('uploads/banners/desktop/' . $banner->image_desktop);
            if (file_exists($desktopImagePath)) {
                unlink($desktopImagePath);
            }
        }

        if ($banner->image_phone) {
            $phoneImagePath = public_path('uploads/banners/phone/' . $banner->image_phone);
            if (file_exists($phoneImagePath)) {
                unlink($phoneImagePath);
            }
        }

        // Delete the database record
        $banner->delete();

        return response()->json(['message' => 'Banner Deleted Successfully']);
    }
}
