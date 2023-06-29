<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class PowerPlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->user()->user_type == 'Admin') {
            return true;
        }
        
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
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'engine_quantity' => ['required', 'integer'],
            'feeder_quantity' => ['required', 'integer'],
            'estimated_usage_amount' => ['required', 'integer'],
            'dead_stock_amount' => ['required', 'integer'],
            'power_plant_type' => ['required'],
            'unit_id' => ['required'],
        ];
    }
}
