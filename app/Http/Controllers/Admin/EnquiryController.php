<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactform;
use DataTables;
use Carbon\Carbon;
class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contactform::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" class="edit fa-solid text-primary fa-eye btn-sm"></a>';
                    $btn = '<a href="javascript:void(0)" class="show fa-solid fa-pen-to-square text-success btn-sm"></a>';
                    $deleteBtn = '<a href="javascript:void(0)" class="delete fa-solid fa-trash text-danger btn-sm"></a>';

                    return $editBtn . ' ' . $btn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.enquiry', compact('user'));
    }
}
