<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinesHour;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Astrologer;
use App\Models\User;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin;
use DataTables;


class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Appointment::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Add your action logic here
                    $completed = '<a href="javascript:void(0)" id="' . $row->id . '" class="statusUpdate text-success btn-sm"> completed  </a>';
                    $remaining = '<a href="javascript:void(0)" id="' . $row->id . '" class="remaining text-danger btn-sm"> Remaining  </a>';
                    return $completed . '' . $remaining;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.appointment', compact('user'));
    }
    public function create(){
        $dataPeriod = CarbonPeriod::create(now(), now()->addDays(6));
        $appointments = [];

        foreach($dataPeriod as $date){
            $dayName = $date->format('l');

            $businesHours = BusinesHour::where('day', $dayName)->first();

            if (!$businesHours || $businesHours->off) {
                // Skip off days
                continue;
            }

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
                'busines_hours' => $hours,
                'off' => $businesHours->off
            ];
        }
        $astrologers = Astrologer::all();
        $services = Service::where('status', '1')->orderby('created_at', 'DESC')->get();
        // $users = User::orderBy('name', 'DESC')->get();
        $user = auth('admin')->user(); // Change here
        $stds = User::all();
        return view('Admins.SuperAdmin.appointment-create', compact('user', 'services', 'appointments','astrologers','stds'));
    }

}
