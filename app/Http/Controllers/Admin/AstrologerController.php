<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Astrologer;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\File;
use DataTables;
class AstrologerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $astrologers = Astrologer::latest()->get();

            foreach ($astrologers as $astro) {
                $astro->image_url = url('./images/Astrologers_Profile_pic/' . $astro->profile_pic);
            }

            return DataTables::of($astrologers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $updateStatus = '<a href="#" data-id="' . $row->id . '"  class="updateStatus fa-solid text-primary fa-eye btn-sm"  ></a>';
                    $editbtn = '<a href="" id="' . $row->id . '" class="editIcon fa-solid text-success fa-pen-to-square btn-sm" data-bs-toggle="modal" data-bs-target="#myModal"></a>';
                    $deleteBtn = '<a href=""  id="' . $row->id . '"  class="deleteAstrologer fa-solid fa-trash text-danger btn-sm" ></a>';

                    return $updateStatus . ' ' . $editbtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $user = auth('admin')->user();
        $services = Service::where('status', '1')
            ->orderby('created_at', 'DESC')
            ->get();
        return view('Admins.SuperAdmin.astrologer', compact('user', 'services'));
    }

    public function create(Request $request)
    {
        $services = Service::where('status', '1')
            ->orderby('created_at', 'DESC')
            ->get();
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.astrologer-create', compact('user', 'services'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'service' => 'required',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a new Astrologer instance without saving it to the database
        $astrologer = new Astrologer();

        // Assign values to the astrologer object
        $astrologer->name = $request->name;
        $astrologer->email = $request->email;
        $astrologer->phone = $request->phone;
        $astrologer->gender = $request->gender;
        $astrologer->service = $request->service;
        $astrologer->status = $request->status;

        // Save the astrologer to get an ID
        $astrologer->save();

        // Now that the ID is available, update the astrologer_id
        $astrologer->astrologer_id = 'ASTRO' . date('Ymd') . str_pad($astrologer->id, 3, '0', STR_PAD_LEFT);

        // Handle file upload
        $file = $request->file('profile_pic');
        $fileName = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/Astrologers_Profile_pic'), $fileName);
        $astrologer->profile_pic = $fileName;

        // Save the astrologer again to update the astrologer_id and profile_pic
        $astrologer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Astrologer Added successfully',
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $astrologer = Astrologer::find($id);
        return response()->json($astrologer);
    }

    public function update(Request $request)
    {
        $astrologer = Astrologer::find($request->use_id);

        // Delete the previous image only if a new image is uploaded
        if ($request->hasFile('profile_pic')) {
            $previousImage = $astrologer->profile_pic;
            $previousImagePath = public_path("images/Astrologers_Profile_pic/{$previousImage}");

            if ($previousImage && File::exists($previousImagePath)) {
                File::delete($previousImagePath);
            }

            // Upload and update the new image
            $file = $request->file('profile_pic');
            $fileName = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/Astrologers_Profile_pic'), $fileName);
            $astrologer->profile_pic = $fileName;
        }

        // Save other fields if needed
        $astrologer->name = $request->name;
        $astrologer->email = $request->email;
        $astrologer->phone = $request->phone;
        $astrologer->gender = $request->gender;
        $astrologer->service = $request->service;
        $astrologer->status = $request->status;

        $astrologer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated!',
        ]);
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $astrologer = Astrologer::find($id);

        if (!$astrologer) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Get the full image file path
        $imagePath = public_path('images/Astrologers_Profile_pic/' . $astrologer->profile_pic);

        // Check if the image file exists in public directory
        if (file_exists($imagePath)) {
            // Delete the image file
            unlink($imagePath);
        }
        // Delete the astrologer
        $astrologer->delete();

        return response()->json(['message' => 'User and associated image deleted successfully']);
    }
   
}
