<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRoomRequest extends FormRequest
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
            "name" => ['nullable', 'string',],
            "floor" => ['required', 'numeric'],
            "num_start" => ['required', 'numeric'],
            "num_end" => ['required', 'numeric'],
            "price" => ['required', 'numeric', 'min:1'],
        ];
    }
}
