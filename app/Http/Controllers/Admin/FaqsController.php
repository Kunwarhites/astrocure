<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Faq;


class FaqsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Faq::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit fa-solid text-primary fa-eye btn-sm"></a>';
                    $editbtn = '<a href="" id="' . $row->id . '" class="editIcon fa-solid fa-pen-to-square text-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>';
                    $deleteBtn = '<a href="" id="' . $row->id . '"  class="delfaq fa-solid fa-trash text-danger btn-sm"></a>';

                    return $btn . ' ' . $editbtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.faq')->with(compact('user'));
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $faq = Faq::find($id);
        return response()->json($faq);
    }

    public function update(Request $request)
    {
        $faq = Faq::find($request->use_id);

        // Save other fields if needed
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;

        $faq->save();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Updated!',
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $faq = Faq::find($id);

        if ($faq) {
            $faq->delete(); // Delete the user
            return response()->json(['message' => 'faq Deleted Successfully']);
        } else {
            return response()->json(['error' => 'faq not found'], 404);
        }
    }


}
