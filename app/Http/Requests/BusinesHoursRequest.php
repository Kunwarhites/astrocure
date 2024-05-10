<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BusinesHoursRequest extends FormRequest
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
        // $data = array_values($this->all()['data']);

        $data = array_values($this->all()['data']);

        foreach ($data as $index => $day) {
            if (!isset($day['off'])) {
                $data[$index]['off'] = false;
                continue;
            }

            $data[$index]['off'] = !!$data[$index]['off'];
        }

        $this->merge([
            'data' => $data
        ]);
    }
    public function rules()
    {
        return [
            'data' => ['array', 'size:7'],
            'data.*.day' => ['required'],
            'data.*.from' => ['required', 'date_format:H:i:s'],
            'data.*.to' => ['required', 'date_format:H:i:s'],
            'data.*.step' => ['required', 'integer', 'min:1'],
            'data.*.off' => ['required', 'boolean'],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors());
        $validator->errors();
    }

}
