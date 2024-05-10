<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Feedback;

class FeedbacksController extends Controller {
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Feedback::latest()->get();
            foreach ($data as $user) {
                $user->image_url = url('images/Feedbacks_Userimage/' . $user->image);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $updateBtn = '<a href="" id="'.$row->id.'" class="editIcon fa-solid text-primary fa-eye btn-sm" data-bs-toggle="modal" data-bs-target="#myFeedModal"></a>';
                    $deleteBtn = '<a href="" id="'.$row->id.'" class="deletefeeds fa-solid fa-trash text-danger btn-sm"></a>';

                    return $updateBtn.' '.$deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.feedback', compact('user'));
    }
    public function edit(Request $request) {
        $id = $request->id;
        $feeds = Feedback::find($id);
        return response()->json($feeds);
    }
    public function update(Request $request) {
        $feeds = Feedback::find($request->use_id);

        // Save other fields if needed
        $feeds->name = $request->name;
        $feeds->email = $request->email;
        $feeds->rating = $request->rating;
        $feeds->comment = $request->comment;
        $feeds->status = $request->status;

        // Check if a new image is provided
        if($request->hasFile('image')) {
            // Delete the existing image if any
            if($feeds->image) {
                // Assuming the images are stored directly in the public path
                unlink(public_path('images/Feedbacks_Userimage/'.$feeds->image));
            }

            // Upload the new image
            $file = $request->file('image');
            $fileName = time().'_'.$request->name.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/Feedbacks_Userimage'), $fileName);

            // Save the image filename in the database
            $feeds->image = $fileName;
        }

        $feeds->save();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated!',
        ]);
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $feedback = Feedback::find($id);

        if($feedback) {
            // Delete the feedback
            $feedback->delete();

            return response()->json(['message' => 'Feedback deleted successfully']);
        } else {
            return response()->json(['error' => 'Feedback not found'], 404);
        }
    }


}
