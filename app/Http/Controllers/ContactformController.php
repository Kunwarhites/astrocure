<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactform;
use Illuminate\Support\Facades\Validator;
class ContactformController extends Controller
{
    public function index(){
        return view('Frontend.contact');
    }
    public function store(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'email'=> 'required|email|unique:contactforms|max:100',
                'subject'=> 'required|max:50',
                'phone'=> 'required',
                'message' => 'required|max:255',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'message' =>  $validator->getMessageBag(),
                ]);
            }else {
                    $contactform = new Contactform();
                    $contactform->name = $request->name;
                    $contactform->email = $request->email;
                    $contactform->subject = $request->subject;
                    $contactform->phone = $request->phone;
                    $contactform->message = $request->message;
                    $contactform->save();
                    return response()->json([
                        'status'=>200,
                        'message' => 'We will Contact you soon!',
                    ]);
            }
    }
}
