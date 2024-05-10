<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\Subadmin;
use App\Models\Service;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Feedback;

use Illuminate\Support\Facades\Validator;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.dashboard')->with(compact('user'));
    }
    public function subdashboard()
    {
        $user = auth('subadmin')->user();
        return view('Admins.SubAdmin.subdashboard')->with(compact('user'));
    }
    public function users(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            foreach ($data as $user) {
                $user->image_url = url('images/profileUser/' . $user->picture);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="' . $row->id . '" class="statusUpdate btn-sm">' . ($row->status == 1 ? '<i class="fa-solid fa-eye text-success"></i>' : '<i class="fa-solid fa-eye-slash text-danger"></i>') . '</a>';
                    $editBtn = '<a href="" id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#editUser_Modal"  class="editIcon fa-solid fa-pen-to-square text-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Details"></a>';
                    $deleteBtn = '<a href=""  id="' . $row->id . '"  class="deleteuser fa-solid fa-trash text-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Delete"></a>';

                    return $btn . ' ' . $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        $userinfo = DB::table('users')->where('id', session('loggedInUser'))->first();
        $services = Service::pluck('name', 'id');
        return view('Admins.SuperAdmin.user', compact('user', 'services','userinfo'));
    }

    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|max:100',
            'phone' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'password' => 'required|min:6|max:100',
            'picture' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        }

        $file = $request->file('picture');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/profileUser'), $fileName);

        // Create a new user with the provided data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'service' => $request->service, // You need to make sure 'service' is a valid field in your User model
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'picture' => $fileName,
        ]);

        // Generate the unique registration ID
        $user->registration_id = 'STD' . date('Ymd') . str_pad($user->id, 3, '0', STR_PAD_LEFT);
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Submitted!',
        ]);
    }

    public function showUser($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $users->image_url = url('images/profileUser/' . $users->picture);
        // dd($users);
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.show-user', compact('user', 'users'));
    }

    public function editUser(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        return response()->json($user);
    }

    public function updateUser(Request $request)
    {
        $fileName = '';
        $use = User::find($request->use_id);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profileUser'), $fileName);

            if ($use->picture) {
                $oldPicturePath = public_path('images/profileUser/' . $use->picture);
                if (file_exists($oldPicturePath)) {
                    unlink($oldPicturePath);
                }
            }
        } else {
            $fileName = $request->use_picture;
        }

        $useData = [
            'name' => $request->name,
            'email' => $request->email,
            'service' => $request->service,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'picture' => $fileName,
        ];

        $use->update($useData);

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated!',
        ]);
    }

//     public function changeStatus($userId)
// {
//     // dd($request->all($id));
//     $user = User::find($userId);
//     dd($user);
//     if (!$user) {
//         return response()->json(['message' => 'User not found'], 404);
//     }

//     try {
//         $user->update(['status' => !$user->status]); // Toggle status
//         return response()->json(['message' => 'Status updated successfully', 'new_status' => $user->status]);
//     } catch (\Exception $e) {
//         return response()->json(['message' => 'Status update failed: ' . $e->getMessage()], 500);
//     }
// }

    public function delUser(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if ($user) {
            // Get the full image file path
            $imagePath = public_path('images/profileUser/' . $user->picture);

            // Check if the image file exists in public directory
            if (file_exists($imagePath)) {
                // Delete the image file
                unlink($imagePath);
            }

            // Delete the user
            $user->delete();

            return response()->json(['message' => 'User and associated image deleted successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
