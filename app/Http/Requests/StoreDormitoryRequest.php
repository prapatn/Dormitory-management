<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDormitoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "photo" => ['mimes:png,jpg,jpeg'],
            "name" => ['required', 'string'],
            "address" => ['required', 'string'],
            "province" => ['required'],
            "amphure" => ['required'],
            "district" => [],
            "phone" => ['required', 'digits:10'],
            "electricity_per_unit" => ['required', 'numeric'],
            "water_per_unit" => ['required', 'numeric', 'min:1'],
            "water_pay_min" => ['numeric', 'min:1'],
            "water_min_unit" => ['numeric', 'min:1'],
        ];
    }
}
