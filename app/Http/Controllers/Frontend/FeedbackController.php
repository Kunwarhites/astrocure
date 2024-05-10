<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FeedbackController extends Controller
{

public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'rating' => 'required',
        'comment' => 'required|max:255',
    ]);

    if($validator->fails()) {
        return response()->json([
            'status' => 400,
            'message' => $validator->getMessageBag(),
        ]);
    } else {
        $feedback = new Feedback();
        $feedback->name = $request->input('name');
        $feedback->email = $request->input('email');
        $feedback->rating = $request->input('rating');
        $feedback->comment = $request->input('comment');
        $feedback->save();
        return response()->json([
            'status' => 200,
            'message' => 'Feedback submitted successfully',
        ]);
    }
}
}
