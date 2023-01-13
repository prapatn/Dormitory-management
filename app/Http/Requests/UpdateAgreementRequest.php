<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAgreementRequest extends FormRequest
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
            "id" => [],
            "user_id" => [],
            "price_guarantee" => ['required', 'numeric'],
            "penalty_per_day" => ['required', 'numeric'],
            'start_date' => ['required', 'date',],
            'end_date' => ['required', 'date', 'after:start_date',],
        ];
    }
}
