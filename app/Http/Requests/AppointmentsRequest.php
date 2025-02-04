<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\BusinesHour;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->isValid();
    }


    public function rules(): array
    {
        return [
            'data' => ['required','date_format:Y-m-d'],
            'time' => ['required','date_format:H:i']
        ];
    }
    private function isValid()
    {
        $dayName = $this->date('date')->format('l');
        $businessHours = BusinesHour::where('day',$dayName)->first()->TimesPeriod;
        if (!in_array($this->input('time'),$businessHours)) {
            abort(422, 'invalid time');
        }
        $isAlreadyExists = Appointment::where('date', $this->input('date'))->where('time', $this->input('time'))->exists();
        if ($isAlreadyExists){
            abort(422, 'already taken');
        }
    }
}
