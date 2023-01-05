<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $data = $this->request->all();
        return [
            "photo" => ['mimes:png,jpg,jpeg'],
            "name" => ['required', 'string', Rule::unique('dormitories')->where('user_id',  Auth::user()->id)->ignore($data['name'])->whereNull('deleted_at')],
            "address" => ['required', 'string'],
            "province" => ['required'],
            "amphure" => ['required'],
            "district" => [],
            "phone" => ['required', 'digits:10'],
            "electricity_per_unit" => ['required', 'numeric'],
            "water_per_unit" => ['required', 'numeric', 'min:1'],
            "water_pay_min" => ['nullable', 'numeric', 'min:1'],
            "water_min_unit" => ['nullable', 'numeric', 'min:1'],
        ];
    }
}
