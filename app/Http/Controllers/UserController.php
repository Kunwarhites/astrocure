<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Mail\RegistrationConfirmation;

class UserController extends Controller
{
    public function index()
    {
        if (session()->has('loggedInUser')) {
            return redirect('/profile');
        } else {
            return view('Frontend.login');
        }
    }
    public function register()
    {
        if (session()->has('loggedInUser')) {
            return redirect('/profile');
        } else {
            return view('Frontend.register');
        }
    }
    public function forget()
    {
        if (session()->has('loggedInUser')) {
            return redirect('/profile');
        } else {
            return view('Frontend.forget');
        }
    }
    public function reset(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        return view('Frontend.reset', ['email' => $email, 'token' => $token]);
    }

    // Handle register user ajax request
    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|max:100',
            'phone' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'password' => 'required|min:6|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->dob = $request->dob;
            $user->password = Hash::make($request->password);
            $user->save();

            // Generate the unique user ID with a prefix (e.g., ASTRO) and the user's database-generated ID.
            $user->registration_id = 'STD' . date('Ymd') . str_pad($user->id, 3, '0', STR_PAD_LEFT);
            $user->save();

            // Send a registration confirmation email with user ID and password
            Mail::to($user->email)->send(new RegistrationConfirmation($user, $request->password));
            return response()->json([
                'status' => 200,
                'message' => 'Registration successful, and an email has been sent.',
            ]);
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loggedInUser', $user->id);
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success',
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'messages' => 'E-mail or password is incorrect!',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'messages' => 'User not Found!',
                ]);
            }
        }
    }

    public function profile()
    {
        if (session()->has('loggedInUser')) {
            // Session variable 'loggedInUser' exists
            $data = [
                'userinfo' => DB::table('users')
                    ->where('id', session('loggedInUser'))
                    ->first(),

            ];
            $services = Service::pluck('name');
            // dd($services);
            return view('Frontend.Profile.profile',$data, compact( 'services'));
        } else {
            // Session variable 'loggedInUser' does not exist
            return view('Frontend.index');
        }
    }

    public function logout()
    {
        if (session()->has('loggedInUser')) {
            session()->pull('loggedInUser');
            return redirect('/');
        }
    }
    // Update user profile image ajax requets public

    public function profileImageUpdate(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Save the new file
            $file->move(public_path('images/profileUser'), $fileName);

            // Delete the old profile picture if it exists
            if ($user->picture) {
                $destination = public_path('images/profileUser/') . $user->picture;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }

            // Update the user record with the new picture file name
            User::where('id', $user_id)->update([
                'picture' => $fileName,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Profile Image Updated Successfully.',
            ]);
        }

        // Handle the case where no file was provided in the request
        return response()->json([
            'status' => 400,
            'message' => 'No image file provided in the request.',
        ]);
    }
    // handle profile update ajax request
    public function profileUpdate(Request $request)
    {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            // 'email' => $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'service' => $request->service,
            // 'phone' => $request->phone,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Profile updated Successfully!',
        ]);
    }
    // handle forgot password ajax request
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        } else {
            $token = Str::uuid();
            $user = DB::table('users')
                ->where('email', $request->email)
                ->first();
            $details = [
                'body' => route('reset', ['email' => $request->email, 'token' => $token]),
            ];
            if ($user) {
                User::where('email', $request->email)->update([
                    'token' => $token,
                    'token_expire' => Carbon::now()
                        ->addMinutes(10)
                        ->toDateTimeString(),
                ]);
                Mail::to($request->email)->send(new ForgotPassword($details));
                return response()->json([
                    'status' => 200,
                    'message' => 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.',
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'This e-mail is not registered with us!',
                ]);
            }
        }
    }
    // handle resetpassword ajax request
    public function resetPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'npass' => 'required|min:6|max:50',
                'cnpass' => 'required|min:6|max:50|same:npass',
            ],
            [
                'cnpass.same' => 'Password did not match!',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag(),
            ]);
        } else {
            $user = DB::table('users')
                ->where('email', $request->email)
                ->whereNotNull('token')
                ->where('token', $request->token)
                ->where('token_expire', '>', Carbon::now())
                ->exists();

            if ($user) {
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->npass),
                    'token' => null,
                    'token_expire' => null,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'New password updated! <a href="/login">Log in</a> now.',
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Reset link expired! Request a new reset password link.',
                ]);
            }
        }
    }
}
