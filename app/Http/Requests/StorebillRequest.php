<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBillRequest extends FormRequest
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
            "room_id" => [],
            "agreement_id" => [],
            "photo" => ['mimes:png,jpg,jpeg'],
            "electricity_unit_last" => ['required', 'integer',],
            "electricity_unit" => ['required', 'integer', 'gt:electricity_unit_last'],
            "water_unit_last" => ['required', 'integer',],
            "water_unit" => ['required', 'integer', 'gt:water_unit_last'],
            "pay_other" => ['nullable', 'integer'],
            "pay_last_date" => ['required', 'date', 'after:now'],
        ];
    }
}
