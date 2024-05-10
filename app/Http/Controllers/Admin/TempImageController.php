<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempFile;
use Illuminate\Http\Request;

class TempImageController extends Controller
{
    function upload(Request $request){
        $temp = new TempFile;
        $temp->name = 'TEMP VALUE';
        $temp->save(); //This will be create a blan entry in DB 'temp_files'

        $image = $request->file('file');

        $destinationPath = './uploads/temp/';
        $extenstion = $image->getClientOriginalExtension();

        $newFileName = $temp->id.'.'.$extenstion;
        $image->move($destinationPath, $newFileName);
        $temp->name = $newFileName;
        $temp->save();

        return response()->json([
            'status' => 200,
            'id' => $temp->id,
            'name' => $newFileName,
        ]);
    }
}
