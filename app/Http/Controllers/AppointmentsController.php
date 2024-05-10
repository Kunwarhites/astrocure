<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentsRequest;
use App\Models\Astrologer;
use App\Models\BusinesHour;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Razorpay\Api\Api;
use DB;
class AppointmentsController extends Controller
{
    public function index(){
        $dataPeriod = CarbonPeriod::create(now(), now()->addDays(6));

        $appointments = [];
        foreach($dataPeriod as $date){
            $dayName = $date->format('l');

            $businesHours = BusinesHour::where('day', $dayName)->first();
            $hours = array_filter($businesHours->TimesPeriod);
            $currentAppointments = Appointment::where('date', $date->toDateString())->pluck('time');

            // Convert the plucked values into a collection and then use map
            $currentAppointments = collect($currentAppointments)->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })->toArray();

            $availableHours = array_diff($hours, $currentAppointments);
            $appointments[] = [
                'day_name' => $dayName,
                'date' => $date->format('d M'),
                'full_date' => $date->format('Y-m-d'),
                'available_Hours' => $availableHours,
                'reserved_hours' => $currentAppointments,
                'busines_hours'=>$hours,
                'off' => $businesHours->off
            ];
        }
        if (session()->has('loggedInUser')) {
            $userinfo = DB::table('users')
                ->where('id', session('loggedInUser'))
                ->first();
            if ($userinfo) {
                $services = Service::all(); // Replace with your actual Service model
                $astrologers = Astrologer::all(); // Replace with your actual Astrologer model
                // return view('Frontend.aboutus', compact('userinfo'));
                return view('Frontend.appointment', compact( 'userinfo','appointments','services','astrologers'));
            }
            elseif(!$userinfo){
                return view('Frontend.login')->with('messageap', 'First login with your credentials!');
            }
        }

        return view('Frontend.appointment',compact( 'appointments'));
    }
    public function reservesAppointment(Request $request) {
        if (session()->has('loggedInUser')) {
            $userId = session('loggedInUser');
            $user = User::find($userId);

            if (!$user) {
                // Handle the case where the user is not found
                return redirect()->back()->with('error', 'User not found!');
            }

            $userName = $user->name;
            $userRid = $user->registration_id;
            $paymentData = "100";

            // Ensure $astrologer_userID is defined before using it
            $astrologer_userID = $request->input('astrologer_userID');

            $data = [
                'user_id' => $userId,
                'user_name' => $userName,
                'user_rid' => $userRid,
                'astrologer_userID' => $astrologer_userID,
                'time' => $request->input('time'),
                'date' => $request->input('date'),
                'payment_data' => $paymentData,
            ];

            Appointment::create($data);
            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } else {
            return redirect()->route('Frontend.login')->with('messageap', 'First login with your credentials!');
        }
    }


}

