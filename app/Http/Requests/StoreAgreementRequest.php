<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Rules\Password;

class StoreAgreementRequest extends FormRequest
{
    use PasswordValidationRules;
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
            'name' => ['string', 'max:255'],
            'phone'     => ['string', 'digits:10', 'unique:users'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => [new Password, 'confirmed', 'string',],
            "photo" => ['mimes:png,jpg,jpeg'],
            "room_id" => [],
            "user_id" => [],
            "price_guarantee" => ['required', 'numeric'],
            'start_date' => ['required', 'date',],
            'end_date' => ['required', 'date', 'after:start_date',],
        ];
    }
}
