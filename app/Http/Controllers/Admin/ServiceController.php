<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use DataTables;

use App\Models\TempFile;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ServiceController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $service = Service::latest()->get();
            foreach ($service as $ser) {
                $ser->image_url = url('./uploads/services/thumb/small/' . $ser->image);
            }
            return DataTables::of($service)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class=" fa-solid text-primary fa-eye btn-sm"  data-toggle="tooltip" data-placement="top" title="View Details"></a>';
                    $editbtn = '<a href="' . route('editService', ['id' => $row->id]) . '" class="fa-solid text-success fa-pen-to-square btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Service"></a>';
                    $deleteBtn = '<a href=""  id="' . $row->id . '"  class="deleteService fa-solid fa-trash text-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Delete"></a>';

                    return $btn  . ' ' . $editbtn  . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.service-list')->with(compact('user'));
    }
    public function create()
    {
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.create-service')->with(compact('user'));
    }

    public function storeService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            // Form validated successfully
            $service = new Service();
            $service->name = $request->name;
            $service->description = $request->description;
            $service->short_description = $request->short_description;
            $service->status = $request->status;
            $service->save();

            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                // if ($tempImage) {
                $tempFileName = $tempImage->name;
                $imageArray = explode('.', $tempFileName);
                $ext = end($imageArray);

                $newFileName = 'service-' . $service->id . '.' . $ext;

                $sourcePath = './uploads/temp/' . $tempFileName;

                // if (file_exists($sourcePath)) {
                // Generate small thumbnail
                $smallOImagePath = './uploads/services/thumb/small/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->fit(360, 220);
                $img->save($smallOImagePath);

                // Generate large thumbnail
                $largeImagePath = './uploads/services/thumb/large/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->resize(1150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($largeImagePath);

                $service->image = $newFileName;
                $service->save();

                // Delete the source image
                File::delete($sourcePath);

                $request->session()->flash('success', 'Service created successfully');

                return response()->json([
                    'status' => 200,
                    // Success
                    'message' => 'Service created successfully',
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

    public function editService($id, Request $request)
    {
        $service = Service::where('id', $id)->first();
        if (empty($service)) {
            $request->session()->flash('error', 'Record not found');
            return redirect()->route('serviceList');
        }
        $data['service'] = $service;
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.edit-service')->with(compact('user', 'service'));
    }

    public function updateService($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            // Form validated successfully

            $service = Service::find($id);
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
            $service->save();

            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                // if ($tempImage) {
                $tempFileName = $tempImage->name;
                $imageArray = explode('.', $tempFileName);
                $ext = end($imageArray);

                $newFileName = 'service-' . strtotime('now') . '-' . $service->id . '.' . $ext;

                $sourcePath = './uploads/temp/' . $tempFileName;

                // if (file_exists($sourcePath)) {
                // Generate small thumbnail
                $smallOImagePath = './uploads/services/thumb/small/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->fit(360, 220);
                $img->save($smallOImagePath);

                // Delete old small thumb image
                $sourcePathsmall = './uploads/services/thumb/small/' . $oldImageName;
                File::delete($sourcePathsmall);

                // Generate large thumbnail
                $largeImagePath = './uploads/services/thumb/large/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->resize(1150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($largeImagePath);

                // Delete old small thumb image
                $sourcePathlarge = './uploads/services/thumb/large/' . $oldImageName;
                File::delete($sourcePathlarge);

                $service->image = $newFileName;
                $service->save();

                // Delete the source image
                File::delete($sourcePath);

            }
            $request->session()->flash('success', 'Service Updated successfully');
            return response()->json([
                    'status' => 200,
                    'message' => 'Service created successfully',
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
    public function delService(Request $request)
    {
        $id = $request->id;
        $service = Service::find($id);

        if ($service) {
            $service->delete(); // Delete the user
            return response()->json(['message' => 'User Deleted Successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
