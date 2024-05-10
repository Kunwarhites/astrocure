<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Admin;
use DataTables;
use App\Models\TempFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
// use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class BlogController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $service = Blog::latest()->get();
            foreach ($service as $ser) {
                $ser->image_url = url('./uploads/blogs/thumb/smalls/' . $ser->picture);
            }
            return DataTables::of($service)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class=" fa-solid text-primary fa-eye btn-sm"  data-toggle="tooltip" data-placement="top" title="View Details"></a>';
                    $editbtn = '<a href="' . route('editblogs', ['id' => $row->id]) . '" class="fa-solid text-success fa-pen-to-square btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Service"></a>';
                    $deleteBtn = '<a href=""  id="' . $row->id . '"  class="delblog fa-solid fa-trash text-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Delete"></a>';

                    return $btn  . ' ' . $editbtn  . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.blogs',compact('user'));
    }
    public function create()
    {
        $postby = Admin::all();
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.create-blogs')->with(compact('user','postby'));
    }

    public function storeblogs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            // Form validated successfully
            $service = new Blog();
            $service->name = $request->name;
            $service->description = $request->description;
            $service->short_description = $request->short_description;
            $service->by = $request->by;
            $service->status = $request->status;
            $service->save();

            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                $tempFileName = $tempImage->name;
                $imageArray = explode('.', $tempFileName);
                $ext = end($imageArray);

                $newFileName = 'blogs-' . $service->id . '.' . $ext;

                $sourcePath = public_path('uploads/temp/' . $tempFileName);

                // Generate small thumbnail
                $smallOImagePath = public_path('uploads/blogs/thumb/smalls/' . $newFileName);
                $largeImagePath = public_path('uploads/blogs/thumb/large/' . $newFileName);

                // Create directories if they don't exist
                File::makeDirectory(dirname($smallOImagePath), 0755, true, true);
                File::makeDirectory(dirname($largeImagePath), 0755, true, true);

                // Generate small thumbnail
                $img = Image::make($sourcePath);
                $img->fit(360, 220);
                $img->save($smallOImagePath);

                // Generate large thumbnail
                $img = Image::make($sourcePath);
                $img->resize(1150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($largeImagePath);

                $service->picture = $newFileName;
                $service->save();

                // Delete the source image
                File::delete($sourcePath);

                $request->session()->flash('success', 'blogs created successfully');

                return response()->json([
                    'status' => 200,
                    // Success
                    'message' => 'blogs created successfully',
                ]);
            }
        } else {
            // Return with errors
            return response()->json([
                'status' => 0,
                // Error
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function editblogs($id, Request $request)
    {
        $service = Blog::where('id', $id)->first();
        if (empty($service)) {
            $request->session()->flash('error', 'Record not found');
            return redirect()->route('blogs');
        }
        $data['service'] = $service;
        $postby = Admin::all();
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.edit-blog')->with(compact('user','postby', 'service'));
    }
    public function updateblog($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            // Form validated successfully

            $service = Blog::find($id);
            if (empty($service)) {
                $request->session()->flash('error', 'Record Not Found.');
                return response()->json([
                    'status' => 0,
                ]);
            }
            $oldImageName = $service->image;

            $service->name = $request->name;
            $service->description = $request->description;
            $service->short_description = $request->short_description;
            $service->status = $request->status;
            $service->by = $request->by;
            $service->save();

            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                if ($tempImage) {
                    $tempFileName = $tempImage->name;
                    $imageArray = explode('.', $tempFileName);
                    $ext = end($imageArray);

                    $newFileName = 'blogs-' . strtotime('now') . '-' . $service->id . '.' . $ext;

                    $sourcePath = './uploads/temp/' . $tempFileName;

                    // Generate small thumbnail
                    $smallOImagePath = './uploads/blogs/thumb/smalls/' . $newFileName;
                    $img = Image::make($sourcePath);
                    $img->fit(360, 220);
                    $img->save($smallOImagePath);

                    // Delete old small thumb image
                    $sourcePathsmall = './uploads/blogs/thumb/smalls/' . $oldImageName;
                    File::delete($sourcePathsmall);

                    // Generate large thumbnail
                    $largeImagePath = './uploads/blogs/thumb/large/' . $newFileName;
                    $img = Image::make($sourcePath);
                    $img->resize(1150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($largeImagePath);

                    // Delete old large thumb image
                    $sourcePathlarge = './uploads/blogs/thumb/large/' . $oldImageName;
                    File::delete($sourcePathlarge);

                    $service->picture = $newFileName;
                    $service->save();

                    // Delete the source image
                    File::delete($sourcePath);
                }
            }

            $request->session()->flash('success', 'blog Updated successfully');
            return response()->json([
                'status' => 200,
                'message' => 'blog Updated successfully',
            ]);
        } else {
            // Return with errors
            return response()->json([
                'status' => 0,
                // Error
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function delblog(Request $request)
    {
        $id = $request->id;
        $service = Blog::find($id);

        if ($service) {
            $service->delete(); // Delete the user
            return response()->json(['message' => 'Blog Deleted Successfully']);
        } else {
            return response()->json(['error' => 'Blog not found'], 404);
        }
    }

}
