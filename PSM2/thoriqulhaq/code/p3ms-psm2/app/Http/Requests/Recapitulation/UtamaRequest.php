<?php

namespace App\Http\Requests\Recapitulation;

use Illuminate\Foundation\Http\FormRequest;

class UtamaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'power_plant_id' => ['required'],
            'date_time' => ['required']
        ];
    }
}
