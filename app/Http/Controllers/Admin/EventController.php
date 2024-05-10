<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\TempFile;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $event = Event::latest()->get();
            foreach ($event as $ser) {
                $ser->image_url = url('./uploads/event/thumb/smalls/' . $ser->picture);
            }
            return DataTables::of($event)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class=" fa-solid text-primary fa-eye btn-sm"  data-toggle="tooltip" data-placement="top" title="View Details"></a>';
                    $editbtn = '<a href="' . route('events.edit', ['id' => $row->id]) . '" class="fa-solid text-success fa-pen-to-square btn-sm" data-toggle="tooltip" data-placement="top" title="Edit event"></a>';
                    $deleteBtn = '<a href=""  id="' . $row->id . '"  class="delevent fa-solid fa-trash text-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Delete"></a>';

                    return $btn  . ' ' . $editbtn  . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.events',compact('user'));
    }
    public function create(){
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.events-create',compact('user'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            // Form validated successfully
            $event = new Event();
            $event->name = $request->name;
            $event->description = $request->description;
            $event->language = $request->language;
            $event->location = $request->location;
            $event->date = $request->date;
            $event->time = $request->time;
            $event->rate = $request->rate;
            $event->hours = $request->hours;
            $event->status = $request->status;
            $event->organized = $request->organized;
            $event->save();

            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                $tempFileName = $tempImage->name;
                $imageArray = explode('.', $tempFileName);
                $ext = end($imageArray);

                $newFileName = 'event-' . $event->id . '.' . $ext;

                $sourcePath = public_path('uploads/temp/' . $tempFileName);

                // Generate small thumbnail
                $smallOImagePath = public_path('uploads/event/thumb/smalls/' . $newFileName);
                $largeImagePath = public_path('uploads/event/thumb/large/' . $newFileName);

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

                $event->picture = $newFileName;
                $event->save();

                // Delete the source image
                File::delete($sourcePath);

                $request->session()->flash('success', 'event created successfully');

                return response()->json([
                    'status' => 200,
                    // Success
                    'message' => 'event created successfully',
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
    public function edit($id, Request $request)
    {
        $event = Event::where('id', $id)->first();
        if (empty($event)) {
            $request->session()->flash('error', 'Record not found');
            return redirect()->route('events');
        }
        $data['event'] = $event;
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.events-edit')->with(compact('user', 'event'));
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            // Form validated successfully

            $event = Event::find($id);
            if (empty($event)) {
                $request->session()->flash('error', 'Record Not Found.');
                return response()->json([
                    'status' => 0,
                ]);
            }
            $oldImageName = $event->image;

            $event->name = $request->name;
            $event->description = $request->description;
            $event->language = $request->language;
            $event->location = $request->location;
            $event->date = $request->date;
            $event->time = $request->time;
            $event->rate = $request->rate;
            $event->hours = $request->hours;
            $event->status = $request->status;
            $event->organized = $request->organized;
            $event->save();

            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                if ($tempImage) {
                    $tempFileName = $tempImage->name;
                    $imageArray = explode('.', $tempFileName);
                    $ext = end($imageArray);

                    $newFileName = 'event-' . strtotime('now') . '-' . $event->id . '.' . $ext;

                    $sourcePath = './uploads/temp/' . $tempFileName;

                    // Generate small thumbnail
                    $smallOImagePath = './uploads/event/thumb/smalls/' . $newFileName;
                    $img = Image::make($sourcePath);
                    $img->fit(360, 220);
                    $img->save($smallOImagePath);

                    // Delete old small thumb image
                    $sourcePathsmall = './uploads/event/thumb/smalls/' . $oldImageName;
                    File::delete($sourcePathsmall);

                    // Generate large thumbnail
                    $largeImagePath = './uploads/event/thumb/large/' . $newFileName;
                    $img = Image::make($sourcePath);
                    $img->resize(1150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($largeImagePath);

                    // Delete old large thumb image
                    $sourcePathlarge = './uploads/event/thumb/large/' . $oldImageName;
                    File::delete($sourcePathlarge);

                    $event->picture = $newFileName;
                    $event->save();

                    // Delete the source image
                    File::delete($sourcePath);
                }
            }

            $request->session()->flash('success', 'event Updated successfully');
            return response()->json([
                'status' => 200,
                'message' => 'event Updated successfully',
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        $event = Event::find($id);

        if ($event) {
            $event->delete(); // Delete the user
            return response()->json(['message' => 'Event Deleted Successfully']);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

}
