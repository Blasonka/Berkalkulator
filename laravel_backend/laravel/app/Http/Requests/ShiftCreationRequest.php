<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ShiftCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $today = Carbon::today()->format('Y-m-d');
        return [
            'date' => 'required|date|before_or_equal:' . $today,
            'start_time' => 'required',
            'end_time' => 'required',
            'hourly_wage' => 'required|integer|min:1000|max:10000',
        ];
    }
}
